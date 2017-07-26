<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Beacon;
use App\Models\Etudiant;
use App\Models\Examen;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class MyController extends Controller
{
    public function getListBeacons()
    {
        $beacons=Beacon::all();
        return response()->json(['error' => false,
                                'result' => $beacons,
                                'status_code'=> 200]);
    }

    public function pushNotif(Request $request)
    {   $token=$request->input('token');
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['title'=> 'Notif','message'=> 'cliquer moi']);
        $option = $optionBuilder->build();
        $data = $dataBuilder->build();
        $downstreamResponse = FCM::sendTo($token, $option,null, $data);
        if ($downstreamResponse->numberFailure() !=0)
        {
            return response()->json(['error' => true,
                                    'result' => 'push notif error',
                                    'status_code'=> 503]);
        }
        else
        {
            return response()->json(['error' => false,
                                    'result' => 'push notif success',
                                    'status_code'=> 200]);

        }

    }
    public function markPresence(Request $request)
    {       
        $cin=$request->input('cin');
        $mdp=$request->input('mdp');
        $token=$request->input('token');
        $id_Beacon=$request->input('id_Beacon');
        $examen=Beacon::find($id_Beacon)->examen;

        $etudiant=Etudiant::where(['CIN'=>$cin,'carte_Etudiant' =>$mdp])->first();
        if(!$etudiant)
        {
            $message="les coordonnees sont fausses";
        }
        else
        {
            $etudiant_inscrit=$examen->etudiants()->find($etudiant->id_Etudiant);
            if(!$etudiant_inscrit)
            {
                $message="Ce compte n'est pas inscrit pour cet examen";
            }
            else 
            {
                $examen->etudiants()->updateExistingPivot($etudiant->id_Etudiant,['present'=> true]);
                $message="Vous etes marques present";
                
            }
        }
         
$optionBuilder = new OptionsBuilder();
$optionBuilder->setTimeToLive(60*20);

//$notificationBuilder = new PayloadNotificationBuilder('Notif');
/*$notificationBuilder->setBody($message)
				    ->setSound('default');*/
				    
$dataBuilder = new PayloadDataBuilder();
$dataBuilder->addData(['qr_code' => $etudiant->qr_code,'message'=> $message,'title'=>'Message']);

$option = $optionBuilder->build();
//$notification = $notificationBuilder->build();
$data = $dataBuilder->build();
$downstreamResponse = FCM::sendTo($token, $option, null, $data);

//$downstreamResponse->numberSuccess();
//$downstreamResponse->numberFailure();
//$downstreamResponse->numberModification();

$tokens_todelete=$downstreamResponse->tokensToDelete();
$tokens_tomodify=$downstreamResponse->tokensToModify();
$tokens_toretry=$downstreamResponse->tokensToRetry();
if (!empty($tokens_todelete))
{
    //delete the token from database
}
 
if(!empty($tokens_tomodify))
{
    $new_token=$tokens_tomodify[$token];
    //add the token to database
} 
 
if(!empty($tokens_toretry))
{
    $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
}
if ($downstreamResponse->numberFailure() !=0)
{
    return response()->json(['error' => true,
                             'result' => 'push notif error',
                                'status_code'=> 503]);
}
else
{
    return response()->json(['error' => false,
                             'result' => 'push notif success',
                                'status_code'=> 200]);

}
}

        
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\Repositories\IBeaconRepository;
use App\Repositories\IEtudiantRepository;
use App\Repositories\IExamenRepository;


class PresenceController extends Controller
{
public function markPresence(Request $request,IBeaconRepository $beaconrepository,IEtudiantRepository $etudiantrepository,IExamenRepository $examenrepository)
    {
        $id_Etudiant=$request->input('id_Etudiant');
        $id_Beacon=$request->input('id_Beacon');
        $examen=$beaconrepository->getOne($id_Beacon)->examen;

        $etudiant=$etudiantrepository->getOne($id_Etudiant);
        if(!$etudiant)
        {
            $message="fausses donnees";
        }
        else
        {   $isregistered=$examenrepository->isRegistered($examen,$etudiant->id_Etudiant);
             
            if(!$isregistered)
            {
                $message="Ce compte n'est pas inscrit pour cet examen";
            }
            else 
            {   $examenrepository->updatePresence($examen,$etudiant->id_Etudiant,['present'=> true]);
                $message="Vous etes marques present";
                
            }
        }
         
$optionBuilder = new OptionsBuilder();
$optionBuilder->setTimeToLive(60*20);
				    
$dataBuilder = new PayloadDataBuilder();
$dataBuilder->addData(['message'=> $message,'title'=>'Message']);

$option = $optionBuilder->build();
$data = $dataBuilder->build();
$downstreamResponse = FCM::sendTo($etudiant->token, $option, null, $data);

$tokens_todelete=$downstreamResponse->tokensToDelete();
$tokens_tomodify=$downstreamResponse->tokensToModify();
$tokens_toretry=$downstreamResponse->tokensToRetry();
if (!empty($tokens_todelete))
{
    //delete the token from database
    $etudiant->token=NULL;
    $etudiantrepository->save($etudiant);
}
 
if(!empty($tokens_tomodify))
{
    $new_token=$tokens_tomodify[$etudiant->token];
    $etudiant->token=$new_token;
    //add the token to database
    $etudiantrepository->save($etudiant);
} 
 
if(!empty($tokens_toretry))
{
    $downstreamResponse = FCM::sendTo($etudiant->token, $option, null, $data);
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

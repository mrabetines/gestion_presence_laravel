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
    private $beaconrepository;
    private $etudiantrepository;
    private $examenrepository;

    public function __construct(IBeaconRepository $beaconrepository,IEtudiantRepository $etudiantrepository,IExamenRepository $examenrepository){
        $this->beaconrepository = $beaconrepository; 
        $this->etudiantrepository = $etudiantrepository; 
        $this->examenrepository = $examenrepository; 
    }
    
    public function markPresence(Request $request)
    {
        $id_Etudiant=$request->input('id_Etudiant');
        $id_Beacon=$request->input('id_Beacon');
        $examen=$this->beaconrepository->getOne($id_Beacon)->examen;

        $etudiant=$this->etudiantrepository->getOne($id_Etudiant);
        if(!$etudiant)
        {
            $message="fausses donnees";
        }
        else
        {   $isregistered=$this->examenrepository->isRegistered($examen,$etudiant->id_Etudiant);
             
            if(!$isregistered)
            {
                $message="Ce compte n'est pas inscrit pour cet examen";
            }
            else 
            {   if($this->examenrepository->isPresent($examen,$etudiant->id_Etudiant))
                 {
                     return response()->json(['error' => false,
                             'result' => 'deja present',
                                'status_code'=> 200]);
                 }
                 else {
                 $this->examenrepository->updatePresence($examen,$etudiant->id_Etudiant,['present'=> true]);
                $message="Vous etes marques present";
                 }
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
        $this->etudiantrepository->save($etudiant);
        }
 
        if(!empty($tokens_tomodify))
        {
        $new_token=$tokens_tomodify[$etudiant->token];
        $etudiant->token=$new_token;
        //add the token to database
        $this->etudiantrepository->save($etudiant);
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

     public function changePresence(Request $request)
    {
        $id_Etudiant=$request->input('id_Etudiant');
        $id_Examen=$request->input('id_Examen');
        $present=$request->input('present');
        //$etudiant=$this->etudiantrepository->getOne($id_Etudiant);
        $examen=$this->examenrepository->getOne($id_Examen);
        $this->examenrepository->updatePresence($examen,$id_Etudiant,['present'=> !$present]);
        return response()->json(['error' => false,
                                'result' => 'change with success',
                                'status_code'=> 200]);
    }

    public function markPresenceqrcode(Request $request)
    {   $qr_code=$request->input('qr_code');
        $id_Examen=$request->input('id_Examen');
        $examen=$this->examenrepository->getOne($id_Examen);
        if($examen)
        {
        $etudiant=$this->etudiantrepository->getByQrCode($qr_code);
        $message="";
        if(!$etudiant)
        $message="etudiant inexistant";
        else
        {  
        $isregistered=$this->examenrepository->isRegistered($examen,$etudiant->id_Etudiant);
        if(!$isregistered)
        {
            $message="l'etudiant n'est pas inscrit dans cet examen";
        }
        else 
        {
        $this->examenrepository->updatePresence($examen,$etudiant->id_Etudiant,['present'=> true]);
        $message="l'etudiant est marqué present";
        }
        }}
        else {
             $message="l'examen n'existe pas";
        }
        return response()->json(['error' => false,
                                'result' => $message,
                                'status_code'=> 200]);

    }

}

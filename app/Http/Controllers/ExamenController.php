<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\IBeaconRepository;
use App\Repositories\IEtudiantRepository;
use App\Repositories\IExamenRepository;


class ExamenController extends Controller
{
    private $examenrepository;
    private $beaconrepository;

    public function __construct(IExamenRepository $examenrepository,IBeaconRepository $beaconrepository)
    {
        $this->examenrepository = $examenrepository; 
        $this->beaconrepository = $beaconrepository; 

    }

    public function getListStudents($id_Examen)
    {   
        $examen=$this->examenrepository->getOne($id_Examen);
        if(!$examen)
        {
            return response()->json(['error' => "examen inexistant"],401);
        }
        else 
        {
            $etudiants=$this->examenrepository->getStudents($examen);
            return response()->json(['error' => false,
                                    'result' => $etudiants,
                                    'status_code'=> 200]);
        }
    }

    public function getListBeacons($id_Examen)
    {    
        $examen=$this->examenrepository->getOne($id_Examen);
        if(!$examen)
        {
            return response()->json(['error' => "examen inexistant"],401);
        }
        else 
        {
            $beacons=$this->examenrepository->getBeacons($examen);
            return response()->json(['error' => false,
                                    'result' => $beacons,
                                    'status_code'=> 200]);
        }
    }

    /*ajouter liste des beacons à un examen donnée.Retourne une liste des beacons affectés par cette méthode.
    Si un beacon est déja affecté , il sera ignorer.*/
    public function addListBeacons(Request $request)
    {
        $id_Beacons=$request->input("id_Beacons");
        $id_Examen=$request->input('id_Examen');
        $examen=$this->examenrepository->getOne($id_Examen);
        if($examen)
        {
            $beacons=array();
            for ($i=0; $i<count($id_Beacons); $i++) 
            {
                $beacon=$this->beaconrepository->getOne($id_Beacons[$i]);
                if($beacon != null && $beacon->id_Examen == null)
                {
                        $beacons[$i]=$beacon;
                }
            }
            $examen->beacons()->saveMany($beacons);
            return response()->json(['error' => false,
                                    'result' => $beacons,
                                    'status_code'=> 200]);
        
        }
        else
        {
            return response()->json(['error' => "examen inexistant"],401);
        }
    }
}
    
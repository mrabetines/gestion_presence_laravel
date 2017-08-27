<?php

namespace App\Http\Controllers;

use App\Repositories\IBeaconRepository;
use Illuminate\Http\Request;
use App\Models\Beacon;

class BeaconController extends Controller
{   private  $beaconrepository;

    public function __construct(IBeaconRepository $beaconrepository)
    {
        $this->beaconrepository = $beaconrepository; 
    }
    
    public function getListBeacons()
    {
        $beacons=$this->beaconrepository->getAll();
        return response()->json(['error' => false,
                                'result' => $beacons,
                                'status_code'=> 200]);
    }

    //cette méthode met à jour un beacon si un id est passé ,l'ajoute dans le cas contraire.
    public function addOrUpdateBeacon(Request $request)
    { 
        $uuid=$request->input("uuid");
        $major=$request->input("major");
        $minor=$request->input("minor");
        $id_Beacon=$request->input("id_Beacon");

        if($id_Beacon)
        {   
            $beacon=$this->beaconrepository->getOne($id_Beacon);
        }

       else
       {
           $beacon=new Beacon();
       }
       if($beacon) 
       {
            $beacon->uuid=$uuid;
            $beacon->major=$major;
            $beacon->minor=$minor;
            $this->beaconrepository->save($beacon);
            return response()->json(['result'=>'succees'],200);
        }

       else
       {
            return response()->json(['result' =>'beacon inexistant'],401);
       }
    }

    public function getListFreeBeacons()
    {
        return response()->json(['error' => false,
                                'result' => $this->beaconrepository->getFreeBeacons(),
                                'status_code'=> 200]);
    }


    public function detachBeacon(Request $request)
    {
        $id_Beacon=$request->input("id_Beacon");
        $beacon=$this->beaconrepository->getOne($id_Beacon);
        if($beacon)
        {
            $beacon->id_Examen= null;
            $this->beaconrepository->save($beacon);
            return response()->json(['result'=>$beacon],200);
        }
        else 
        {
            return response()->json(['result' =>'beacon inexistant'],401);
        }

   }

   public function getBeacon($id_Beacon)
    { 
        $beacon=$this->beaconrepository->getOne($id_Beacon);
        if($beacon)
        {
            return response()->json(['error' => false,
                                'result' => $beacon,
                                'status_code'=> 200]);
        }
        else 
        {
            return response()->json(['result'=>'beacon inexistant'],401);
        }
   }

   public function deleteBeacon($id_Beacon)
    {  
        $beacon=$this->beaconrepository->getOne($id_Beacon);
        if($beacon)
        {
            $beacon->delete();
            return response()->json(['error' => false,
                                    'result' => 'suppression effectuée avec succées',
                                        'status_code'=> 200]);
        }
        else
        {
            return response()->json(['result' =>'beacon inexistant'],401);
        }

   }
    
}
<?php

namespace App\Http\Controllers;

use App\Repositories\IBeaconRepository;
use Illuminate\Http\Request;
use App\Models\Beacon;

class BeaconController extends Controller
{   private  $beaconrepository;

    public function __construct(IBeaconRepository $beaconrepository){
        $this->beaconrepository = $beaconrepository; 
    }
    
    public function getListBeacons()
    {
        $beacons=$this->beaconrepository->getAll();
        return response()->json(['error' => false,
                                'result' => $beacons,
                                'status_code'=> 200]);
    }

    public function addBeacon(Request $request)
    { $uuid=$request->input("uuid");
      $major=$request->input("major");
      $minor=$request->input("minor");
      $id_Beacon=$request->input("id_Beacon");
       if($id_Beacon != null)
       {   $beacon=$this->beaconrepository->getOne($id_Beacon);
            
       }
       else{
           $beacon=new Beacon();
       } 
      $beacon->uuid=$uuid;
      $beacon->major=$major;
      $beacon->minor=$minor;
      $this->beaconrepository->save($beacon);
      return response()->json(['result'=>'succees'],200);
    }

    public function getListFreeBeacons()
    {
        return response()->json(['error' => false,
                                'result' => $this->beaconrepository->getFreeBeacons(),
                                'status_code'=> 200]);
    }

    public function detachBeacon(Request $request)
   { $id_Beacon=$request->input("id_Beacon");
     $beacon=$this->beaconrepository->getOne($id_Beacon);
     $beacon->id_Examen= null;
     $this->beaconrepository->save($beacon);
     return response()->json(['result'=>$beacon],200);

   }

   public function getBeacon(Request $request)
   {$id_Beacon=$request->input("id_Beacon");
    $beacon=$this->beaconrepository->getOne($id_Beacon);
     if($beacon != null)
     return response()->json(['error' => false,
                              'result' => $beacon,
                               'status_code'=> 200]);
     else 
     return response()->json(['result'=>'beacon non trouvé'],401);
   }

   public function deleteBeacon(Request $request)
   {$id_Beacon=$request->input("id_Beacon");
    $beacon=$this->beaconrepository->getOne($id_Beacon);
    $beacon->delete();
    return response()->json(['error' => false,
                              'result' => 'suppression effectuée avec succées',
                                'status_code'=> 200]);

   }
    
}
<?php

namespace App\Http\Controllers;

use App\Repositories\IBeaconRepository;

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
}
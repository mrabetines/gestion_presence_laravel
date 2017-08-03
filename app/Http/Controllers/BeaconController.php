<?php

namespace App\Http\Controllers;

use App\Repositories\IBeaconRepository;

class BeaconController extends Controller
{
    public function getListBeacons(IBeaconRepository $beaconrepository)
    {
        $beacons=$beaconrepository->getAll();
        return response()->json(['error' => false,
                                'result' => $beacons,
                                'status_code'=> 200]);
    }
}
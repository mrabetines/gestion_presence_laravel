<?php

namespace App\Repositories;

use App\Models\Beacon;

class BeaconRepository implements IBeaconRepository
{   public function getAll()
    {
        return Beacon::all();
    }
    public function save($beacon)
    {
        $beacon->save();
    }
    public function getOne($id)
    {
        return Beacon::find($id);
    }

    public function getFreeBeacons(){
        return Beacon::where('id_Examen',"=",null)->get();
    }

}
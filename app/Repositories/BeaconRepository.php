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

    public function getFreeBeacons($id_Examen,$date){
        $beacons=Beacon::all();
        $freeBeacons=array();
        foreach ($beacons as $beacon)
        {   
            if(empty($beacon->examens))
            {
                array_push($freeBeacons,$beacon);
            }
            else
            {   
                $libre=true;
                foreach ($beacon->examens as $examen)
                {
                    if($examen->date === $date && $examen->id_Examen != $id_Examen)
                    {
                         $libre=false;
                    }
                    
                }
                if($libre==true)
                {
                    array_push($freeBeacons,$beacon);
                }

            }

        }

        return $freeBeacons;
    }

    public function delete($beacon)
    {
        $beacon->examens()->detach();
        $beacon->delete();

    }

}
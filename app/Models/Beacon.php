<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beacon extends Model
{
    //
    protected $table = 'Beacon';
    public $primaryKey='id_Beacon';
    public $timestamps = false;


    /*public function examen()
    {
        return $this->belongsTo('App\Models\Examen','id_Examen');
    }*/

    public function examens()
    {
        return $this->belongsToMany('App\Models\Examen','Beacon_Examen','id_Beacon','id_Examen');
    }
}

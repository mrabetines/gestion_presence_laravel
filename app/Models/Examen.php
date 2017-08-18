<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    //
    protected $table = 'Examen';
    public $primaryKey='id_Examen';
    public $timestamps = false;

    public function etudiants()
    {
        return $this->belongsToMany('App\Models\Etudiant','Etudiant_Examen','id_Examen','id_Etudiant')->withPivot('present');
    }

    public function beacons()
    {
         return $this->hasMany('App\Models\Beacon','id_Examen');
    }

     public function delete()
    {
        $this->beacons()->delete();
         
    }
}

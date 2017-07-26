<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    //
    protected $table = 'Etudiant';
    public $primaryKey='id_Etudiant';
    public $timestamps = false;
}

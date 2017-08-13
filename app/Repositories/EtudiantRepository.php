<?php

namespace App\Repositories;

use App\Models\Etudiant;

class EtudiantRepository implements IEtudiantRepository
{   public function getByCredentials($email,$pwd)
    {
        return Etudiant::where(['email'=>$email,'password' =>$pwd])->first();
    }
    public function getByQrCode($qr_code)
    {
        return Etudiant::where(['qr_code'=>$qr_code])->first();
    }
    public function getOne($id)
    {
        return Etudiant::find($id);
    }
    public function save($etudiant)
    {
        $etudiant->save();
    }
    

}
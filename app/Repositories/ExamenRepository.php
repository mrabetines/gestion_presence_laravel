<?php

namespace App\Repositories;

use App\Models\Examen;

class ExamenRepository implements IExamenRepository
{    
    public function getStudents($examen)
    {
        return $examen->etudiants;
    }

    public function getOne($id)
    {
        return Examen::find($id);
    }

    public function updatePresence($examen,$id_etudiant,$array)
    {
        $examen->etudiants()->updateExistingPivot($id_etudiant,$array);
    }

    public function isRegistered($examen,$id_Etudiant)
    {
        $etudiant_inscrit=$examen->etudiants()->find($id_Etudiant);
        if($etudiant_inscrit)
        {
            return true;
        }
        else 
        {
            return false;
        }
    }

    public function isPresent($examen,$id_Etudiant)
    {
        return $examen->etudiants()->find($id_Etudiant)->pivot->present;
        
    }
    

}
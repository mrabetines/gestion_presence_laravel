<?php

namespace App\Repositories;

interface IExamenRepository 
{
    public function getStudents($examen);
    public function getBeacons($examen);
    public function getOne($id);
    public function updatePresence($examen,$id_etudiant,$array);
    public function isRegistered($examen,$id_Etudiant);
    public function getExamensByDate($examens,$date);
    public function getExamensByBeacon($beacon);
}
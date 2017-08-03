<?php

namespace App\Repositories;

interface IEtudiantRepository 
{
    public function getByCredentials($email,$pwd);
    public function getOne($id);
    public function save($student);
}
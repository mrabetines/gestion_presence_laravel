<?php

namespace App\Repositories;

interface IBeaconRepository 
{
    public function getAll();
    public function save($beacon);
    public function getOne($id);
}
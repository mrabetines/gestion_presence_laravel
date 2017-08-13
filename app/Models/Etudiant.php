<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject as AuthenticatableUserContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Etudiant extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
  //  CanResetPasswordContract,
    AuthenticatableUserContract
{  use Authenticatable, Authorizable;
   
    //
    protected $table = 'Etudiant';
    public $primaryKey='id_Etudiant';
    public $timestamps = false;

     public function getJWTIdentifier()
    {
        return $this->getKey();  // Eloquent model method
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
        
    }

public function setPasswordAttribute($pass){

$this->attributes['password'] = Hash::make($pass);

}
}

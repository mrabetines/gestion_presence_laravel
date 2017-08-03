<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\IEtudiantRepository;
 
class EtudiantController extends Controller
{
    
    public function login(Request $request,IEtudiantRepository $etudiantrepository)
    {  
        $email=$request->input('email');
        $pwd=$request->input('pwd');
        $token=$request->input('token');
        $etudiant=$etudiantrepository->getByCredentials($email,$pwd);
        if(!$etudiant)
        {
             return response()->json(['error' => true,
                                'result' => 'can\'t find account',
                                'status_code'=> 404]);
        }
        else
        {
            $etudiant->token=$token;
            $etudiantrepository->save($etudiant);
            return response()->json(['error' => false,
                                    'result' => [$etudiant->id_Etudiant,$etudiant->qr_code],
                                    'status_code'=> 200]);
}}
}
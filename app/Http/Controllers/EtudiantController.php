<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\IEtudiantRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
 
class EtudiantController extends Controller
{   
    private $etudiantrepository;
  
    public function __construct(IEtudiantRepository $etudiantrepository)
    {
        $this->etudiantrepository = $etudiantrepository;    
    }

    protected function guard()
    {
        return Auth::guard();
    }
    
    public function login(Request $request)
    {   $credentials = $request->only('email', 'password');
        $fcm_token=$request->input('token');
        try {
                if (!$token = $this->guard()->attempt($credentials)) 
                {
                    return response()->json(['error' => true,
                                    'result' => 'compte inexistant',
                                    'status_code'=> 404]);
                }
            }

        catch (JWTException $e) 
        {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could not create token'],500);
        }

        $etudiant=$this->guard()->user();
        $etudiant->token=$fcm_token;
        $this->etudiantrepository->save($etudiant);
        return response()->json(['error' => false,
                                    'result' => [$etudiant->id_Etudiant,$etudiant->qr_code,$token],
                                    'status_code'=> 200]);
    }

}
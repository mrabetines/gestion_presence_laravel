<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\IBeaconRepository;
use App\Repositories\IEtudiantRepository;
use App\Repositories\IExamenRepository;


class ExamenController extends Controller
{
    private $examenrepository;

    public function __construct(IExamenRepository $examenrepository)
    {
        $this->examenrepository = $examenrepository; 
    }

    public function getListStudents(Request $request)
    {   $id=$request->input('id_Examen');
        $examen=$this->examenrepository->getOne($id);
        if(!$examen)
        {
            return response()->json(['error' => true,
                                'result' => 'can\'t fin exam',
                                'status_code'=> 404]);
        }
        else 
        {
        $etudiants=$this->examenrepository->getStudents($examen);
        return response()->json(['error' => false,
                                'result' => $etudiants,
                                'status_code'=> 200]);
        }
    }

}
    
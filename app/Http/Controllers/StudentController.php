<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;

class StudentController extends Controller
{
    //affichage
    public function display(Request $request){
        $student = Etudiant::get();
        return response()->json($student);
    }

    public function filter(Request $request,$id){
        $query = Etudiant::query();

        // Recherche par nom ou par id
        if($request->has('search')){
            $query = $request->input('search');
            $query->where('id_etudiant',$id);
        }

        $student =  $query->get();

        return response()->json($student);
        
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;

class StudentController extends Controller
{
    //affichage
    public function display(Request $request){
        $query = Etudiant::query();

        // Recherche par nom ou par id
        if($request->has('search')){
            $search = $request->input('search');
            $query->where('id_etudiant',$search)
                  ->orwhere('id_personne',$search);
        }

        // Filtre par niveau 
        if($request->has('level') && $request->input !="Tous les niveau"){
            $query->where('niveau',$request->input('level'));
        }

        // Filtre pas status
        if($request->has('status') && $request->input !="Tous les status"){
            $query->where('status',$request->input('status'));
        }

        $student =  $query->get();

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

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
}

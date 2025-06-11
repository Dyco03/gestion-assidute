<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\Attribution;

class StudentController extends Controller
{
    //affichage
    public function display(Request $request){
        $query = new Etudiant();

        // Jointure naturelle entre la tables etudiants et niveaux
        $query = $query->join("niveaux",'etudiants.id_niveau','=','niveaux.id_niveau');

        // Jointure naturelle entra la tables etudiants et personnes

        $query = $query->join("personnes",'etudiants.id_personne','=','personnes.id_personne');
        
        $query->select('etudiants.*','niveaux.niveau as niveau','personnes.nom as nom','personnes.prenom as prenom');

        // Recherche par nom ou par id
        if($request->has('search')){
            $search = trim(preg_replace('/\s+/',' ',$request->input('search')));
            $mots = array_filter(explode(' ',$search));
            foreach($mots as $mot){
                $query->where('id_etudiant',$mot)
                  ->orwhere('nom','like',"%$mot%")
                  ->orwhere('prenom','like',"%$mot%");
            }
            
        }

        // Filtre par niveau 
        if($request->has('level') && $request->input !="Tous les niveau"){
            $query->where('niveau',$request->input('level'));
        }

        // Filtre pas status
        if($request->has('status') && $request->input !="Tous les status"){
            $query->where('status',$request->input('status'));
        }

        $students =  $query->get();

        // Creation du data json
        $data = [];
        
        foreach($students as $student){
            $total_point = $this->point_calcul($student->id_etudiant); 
            $data [] = [
                'id' => $student->id_etudiant,
                'nom' => $student->nom ." ". $student->prenom,
                'niveau' => $student->niveau,
                'points' => $total_point,
                'lastActivity' => 'none',
                'status' => 'none',
            ];
        }

        return response()->json($data);
    }

    //fonction pour le calcul du total de points pour chaque personnes
    private function point_calcul($id_etudiant){
        $total_point = 0;

        $attributions = Attribution::query();

        //Jointure naturelles entre la table attribution et raisons
        $attributions->join('raisons','raisons.id_raison','=','attributions.id_raison');

        $attributions->where('id_etudiant',$id_etudiant);

        $attributions = $attributions->get();

        //calcul du total de points pour chaque personnes

        foreach($attributions as $attribution){
            $total_point += $attribution->point;
        }
    
        return $total_point;
    }

}

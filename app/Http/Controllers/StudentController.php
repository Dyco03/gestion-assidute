<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\Attribution;
use App\Models\Raison;

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
        
        foreach($students as $student){; 
            $last_activity = $this->last_activity($student->id_etudiant);
            $data [] = [
                'id' => $student->id_etudiant,
                'nom' => $student->nom ." ". $student->prenom,
                'niveau' => $student->niveau,
                'points' => $student->calcul_point(),
                'lastActivity' => $last_activity,
                'status' => 'none',
            ];
        }

        return response()->json($data);
    }

    public function display_raison(){
        $raisons = Raison::query()
                ->orderBy('point','desc')
                ->get();

        $data = [];

        foreach($raisons as $raison){
            $type = ($raison->point<0)?'malus':'bonus';
            $data [] = [
                'id' => $raison->id_raison,
                'label' => $raison->nom,
                'points' => $raison->point,
                'type' => $type
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

    //fonction pour la dernière activité
    private function last_activity($id_etudiant){
        $attributions = Attribution::query();

        $last_activity = $attributions->where('id_etudiant',$id_etudiant)
                                      ->orderBy('created_at','desc')
                                      ->first();

        if($last_activity){
            return $last_activity->created_at;
        }
        else{
            return null;
        }
        

    }
    // Fonction pour stocker une attribution

    public function store(Request $request){

        $data = $request->validate([
            'id_etudiant' => "required|integer",
            'id_raison'=> 'required|integer',
            'id_enseignement' => 'required|integer',
        ]);

        $attribution = Attribution::create($data);

        return response()->json($data);
    }

    /*

    public function store(Request $request) {
        $validated = $request->validate([
            'id_etudiant' => 'required|exists:etudiants,id_etudiant',
            'id_enseignement' => 'required|exists:enseignements,id_enseignement',
            'id_raison' => 'required|exists:raisons,id_raison',
        ]);

        $attribution = Attribution::create($validated);

        return response()->json([
            'message' => 'Attribution enregistrée avec succès.',
            'data' => $attribution
        ], 201);
    }
       
    */

}

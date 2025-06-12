<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Attribution;

class Etudiant extends Model
{
    protected $fillable = [
        'id_personne',
        'id_niveau',
        'status'
    ];
    protected $primaryKey = 'id_etudiant';
    protected $table = 'etudiants';
    public $timestamps = true;
    protected $casts = [
        'id_personne' => 'integer',
        'id_niveau' => 'integer',
    ];

    public function personne()
    {
        return $this->belongsTo(Personne::class, 'id_personne', 'id_personne');   
    }

    public function calcul_point()
    {
        $attributions = Attribution::get();
        $totalPoints = 0;
        foreach($attributions as $attribution) {
            if ($attribution->id_etudiant == $this->id_etudiant) {
                $totalPoints += $attribution->raison->point;
            }
        }

        return $totalPoints;
    }
}

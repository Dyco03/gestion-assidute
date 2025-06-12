<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribution extends Model
{
    protected $fillable = [
        'id_enseignement',
        'id_etudiant',
        'id_raison',
    ];
    protected $primaryKey = 'id_attribution';
    protected $table = 'attributions';
    public $timestamps = true;
    protected $casts = [
        'id_enseignement' => 'integer',
        'id_matiere' => 'integer',
        'id_etudiant' => 'integer',
    ];

    public function enseignement()
    {
        return $this->belongsTo(Enseignement::class, 'id_enseignement', 'id_enseignement');
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'id_matiere', 'id_matiere');
    }

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'id_etudiant', 'id_etudiant');
    }
    public function niveau()
    {
        return $this->belongsTo(Niveau::class, 'id_niveau', 'id_niveau');
    }
    public function raison()
    {
        return $this->belongsTo(Raison::class, 'id_raison', 'id_raison');
    }
    public function prof()
    {
        return $this->belongsTo(Prof::class, 'id_prof', 'id_prof');
    }
    public function personne()
    {
        return $this->belongsTo(Personne::class, 'id_personne', 'id_personne');
    }
}

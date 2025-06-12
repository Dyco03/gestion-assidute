<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    protected $fillable = [
        'id_niveau',
        'libelle',
        'id_filiere'
    ];
    protected $primaryKey = 'id_niveau';
    protected $table = 'niveaux';
    public $timestamps = true;
    protected $casts = [
        'id_niveau' => 'integer',
        'id_filiere' => 'integer',
    ];

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class, 'id_niveau', 'id_niveau');
    }
    public function attributions()
    {
        return $this->hasMany(Attribution::class, 'id_niveau', 'id_niveau');
    }
    public function raisons()
    {
        return $this->hasMany(Raison::class, 'id_niveau', 'id_niveau');
    }
    public function enseignements()
    {
        return $this->hasMany(Enseignement::class, 'id_niveau', 'id_niveau');
    }
    public function matieres()
    {
        return $this->hasMany(Matiere::class, 'id_niveau', 'id_niveau');
    }
    public function profs()
    {
        return $this->hasMany(Prof::class, 'id_niveau', 'id_niveau');
    }
}

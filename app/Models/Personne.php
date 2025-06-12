<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    protected $fillable = [
        'id_personne',
        'nom',
        'prenom',
        'email',
        'telephone'
    ];
    protected $primaryKey = 'id_personne';
    protected $table = 'personnes';
    public $timestamps = true;
    protected $casts = [
        'id_personne' => 'integer',
    ];

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class, 'id_personne', 'id_personne');
    }
    
    public function profs()
    {
        return $this->hasMany(Prof::class, 'id_personne', 'id_personne');
    }
}

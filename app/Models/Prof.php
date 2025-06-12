<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prof extends Model
{
    protected $fillable = [
        'id_personne',
        'grade',
        'status'
    ];
    protected $primaryKey = 'id_prof';
    protected $table = 'profs';
    public $timestamps = true;
    protected $casts = [
        'id_personne' => 'integer',
    ];

    public function personne()
    {
        return $this->belongsTo(Personne::class, 'id_personne', 'id_personne');
    }

    public function enseignements()
    {
        return $this->hasMany(Enseignement::class, 'id_prof', 'id_prof');
    }
    public function niveaux()
    {
        return $this->hasMany(Niveau::class, 'id_prof', 'id_prof');
    }   
}

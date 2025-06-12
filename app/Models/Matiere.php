<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    protected $fillable = [
        'id_matiere',
        'libelle',
        'coefficient'
    ];
    protected $primaryKey = 'id_matiere';
    protected $table = 'matieres';
    public $timestamps = true;
    protected $casts = [
        'id_matiere' => 'integer',
        'coefficient' => 'float',
    ];
    public function enseignements()
    {
        return $this->hasMany(Enseignement::class, 'id_matiere', 'id_matiere');
    }
    public function attributions()
    {
        return $this->hasMany(Attribution::class, 'id_matiere', 'id_matiere');
    }
    public function raisons()
    {
        return $this->hasMany(Raison::class, 'id_matiere', 'id_matiere');
    }
}

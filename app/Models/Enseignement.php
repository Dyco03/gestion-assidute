<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enseignement extends Model
{
    protected $fillable = [
        'id_prof',
        'id_matiere',
        'type'
    ];
    protected $primaryKey = 'id_enseignement';
    protected $table = 'enseignements';
    public $timestamps = true;
    protected $casts = [
        'id_prof' => 'integer',
        'id_matiere' => 'integer',
    ];
    public function prof()
    {
        return $this->belongsTo(Prof::class, 'id_prof', 'id_prof');
    }
    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'id_matiere', 'id_matiere');
    }
    public function attributions()
    {
        return $this->hasMany(Attribution::class, 'id_enseignement', 'id_enseignement');
    }
}

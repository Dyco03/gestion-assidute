<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Raison extends Model
{
    protected $fillable = [
        'id_matiere',
        'point'
    ];  
}

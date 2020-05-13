<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $table = 'cidades';
    public $timestamps = false;
    
    public function estado() 
    {
        return $this->belongsTo(Estado::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Natureza extends Model
{
    protected $table = 'naturezas';
    
    public function empenhos() 
    {
        return $this->hasMany(Empenho::class);
    }
}

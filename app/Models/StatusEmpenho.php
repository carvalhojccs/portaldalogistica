<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusEmpenho extends Model
{
    protected $table = 'status_empenhos';
    
    public function empenhos() 
    {
        return $this->hasMany(Empenho::class);
    }
}

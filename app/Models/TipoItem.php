<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoItem extends Model
{
    protected $table = 'tipos_itens';
    
    public function empenhos() 
    {
        return $this->hasMany(Empenho::class);
    }
}

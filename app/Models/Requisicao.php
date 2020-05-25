<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requisicao extends Model
{
    protected $table = 'requisicoes';
    protected $fillable = ['item_empenho_autorizado_id', 'requisicao' ];
    
    public function itemEmpenhoAutorizado() 
    {
        return $this->belongsTo(ItemEmpenhoAutorizado::class);
    }
}

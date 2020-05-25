<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemEmpenhoAutorizado extends Model
{
    protected  $table = 'itens_empenhos_autorizados';
    protected $fillable = ['item_empenho_id','autorizado'];
    
    public function itemEmpenho() 
    {
        return $this->belongsTo(ItemEmpenho::class);
    }
    
    public function requisicoes() 
    {
        return $this->hasMany(Requisicao::class);
    }
}

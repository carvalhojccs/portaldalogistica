<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemEmpenho extends Model
{
    protected $table = 'itens_empenhos';
    protected $fillable = [
        'status_item_empenho_id',
        'empenho_id',
        'descricao',
        'quantidade',
        'valor',
    ];
    
    public function empenho() 
    {
        return $this->belongsTo(Empenho::class);
    }
    
    public function statusItemEmpenho() 
    {
        return $this->belongsTo(StatusItemEmpenho::class);
    }
    
    public function itensEmpenhoAutorizados() 
    {
        return $this->hasMany(ItemEmpenhoAutorizado::class);
    }
}

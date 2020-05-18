<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empenho extends Model
{
    protected $table = 'empenhos';
    protected $fillable = [
        'tipo_item_id',
        'empresa_id',
        'linha_credito_id',
        'natureza_id',
        'status_empenho_id',
        'empenho',
        'solicitacao',
        'data_solicitacao',
        'valor_solicitacao',
        'processo',
    ];
    
    public function tipoItem() 
    {
        return $this->belongsTo(TipoItem::class);
    }
    
    public function empresa() 
    {
        return $this->belongsTo(Empresa::class);
    }
    
    public function linhaCredito() 
    {
        return $this->belongsTo(LinhaCredito::class);
    }
    
    public function natureza() 
    {
        return $this->belongsTo(Natureza::class);
    }
    
    public function statusEmpenho() 
    {
        return $this->belongsTo(StatusEmpenho::class);
    }
    
    public function itensEmpenhos() 
    {
        return $this->hasMany(ItemEmpenho::class);
    }
}

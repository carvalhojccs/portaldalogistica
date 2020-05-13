<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';
    protected $fillable = [
        'estado_id',
        'cidade_id',
        'cnpj',
        'nome',
        'email',
    ];
    
    public function estado() 
    {
        return $this->belongsTo(Estado::class);
    }
    
    public function cidade() 
    {
        return $this->belongsTo(Cidade::class);
    }
    
    public function telefones() 
    {
        return $this->hasMany(Telefone::class);
    }
    
    public function colaboradores() 
    {
        return $this->hasMany(Colaborador::class);
    }
    
    
    public function empenhos() 
    {
        return $this->hasMany(Empenho::class);
    }
}

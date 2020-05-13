<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    protected $table = 'telefones';
    protected $fillable = [
        'empresa_id',
        'numero',    
    ];
    
    public $timestamps = false;
    
    public function emppresa() 
    {
        return $this->belongsTo(Empresa::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusItemEmpenho extends Model
{
    protected $table = 'status_itens_empenhos';
    protected $fillable = ['status'];
    
    public function empenho() 
    {
        return $this->belongsTo(ItemEmpenho::class);
    }
}

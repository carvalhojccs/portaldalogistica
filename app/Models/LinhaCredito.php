<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinhaCredito extends Model
{
    protected $table = 'linhas_creditos';
    protected $fillable = [
        'user_id',
        'pi',
        'ptres',
        'fonte',
    ];
    
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
    
    public function empenhos() 
    {
        return $this->hasMany(Empenho::class);
    }
}

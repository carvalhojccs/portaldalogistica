<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $table = 'locais';
    protected $fillable = [
        'nome',
        'sigla',
    ];
    
    public function users() 
    {
        return $this->hasMany(User::class);
    }
    
    public function search(array $filters) 
    {
        return $this->where(function($query) use($filters){
            if($filters['nome']):
                $query->where('nome','like',"%{$filters['nome']}%");
            endif;
            if($filters['sigla']):
                $query->where('sigla','like',"%{$filters['sigla']}%");
            endif;
        })->paginate();
    }
}

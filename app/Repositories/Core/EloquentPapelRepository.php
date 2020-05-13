<?php

namespace App\Repositories\Core;
	
use App\Models\Papel;
use App\Repositories\Contracts\PapelRepositoryInterface;

class EloquentPapelRepository extends BaseEloquentRepository implements PapelRepositoryInterface
{
    public function entity()
    {
        return Papel::class;
    }

    public function search(array $filters)
    {
        
        
        return $this->entity->where(function($query) use ($filters){
            if($filters['nome']):
                $query->where('nome','like',"%{$filters['nome']}%");
            endif;
            
            if($filters['descricao']):
                $query->where('descricao','like',"%{$filters['descricao']}%");
            endif;
        })->paginate();
    }
}

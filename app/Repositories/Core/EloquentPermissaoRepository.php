<?php

namespace App\Repositories\Core;
	
use App\Models\Permissao;
use App\Repositories\Contracts\PermissaoRepositoryInterface;

class EloquentPermissaoRepository extends BaseEloquentRepository implements PermissaoRepositoryInterface
{
    public function entity()
    {
        return Permissao::class;
    }

    public function search(array $filters)
    {
//        return $this->entity->where(function($query) use ($filters){
//            if($filters['nome']):
//                $query->where('nome','like',"%{$filters['nome']}%");
//            endif;
//            
//            if($filters['descricao']):
//                $query->where('descricao','like',"%{$filters['descricao']}%");
//            endif;
//        })->paginate();
    }
}

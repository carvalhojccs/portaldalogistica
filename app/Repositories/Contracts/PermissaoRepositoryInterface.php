<?php

namespace App\Repositories\Contracts;
	
interface PermissaoRepositoryInterface
{
    public function search(array $filters);
}
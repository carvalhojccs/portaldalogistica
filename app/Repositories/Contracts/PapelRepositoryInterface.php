<?php

namespace App\Repositories\Contracts;
	
interface PapelRepositoryInterface
{
    public function search(array $filters);
}
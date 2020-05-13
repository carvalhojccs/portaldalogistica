<?php

namespace App\Providers;

use App\Repositories\Contracts\PapelRepositoryInterface;
use App\Repositories\Contracts\PermissaoRepositoryInterface;

use App\Repositories\Core\EloquentPapelRepository;
use App\Repositories\Core\EloquentPermissaoRepository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PapelRepositoryInterface::class, EloquentPapelRepository::class);
        $this->app->bind(PermissaoRepositoryInterface::class, EloquentPermissaoRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

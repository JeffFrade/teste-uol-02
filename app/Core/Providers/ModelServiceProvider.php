<?php

namespace App\Core\Providers;

use App\Observers\AlunoObserver;
use App\Observers\CursoObserver;
use App\Repositories\Models\Aluno;
use App\Repositories\Models\Curso;
use Illuminate\Support\ServiceProvider;

class ModelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Aluno::observe(AlunoObserver::class);
        Curso::observe(CursoObserver::class);
    }
}

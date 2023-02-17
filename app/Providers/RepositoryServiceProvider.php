<?php

namespace App\Providers;
use App\Contracts\Repositories\QuizeRepository;
use App\Contracts\Repositories\QuestionRepository;
use App\Contracts\Repositories\AnswerRepository;
use App\Contracts\Repositories\SubmitRepository;
use App\Repositories\QuizeRepositoryEloquent;
use App\Repositories\QuestionRepositoryEloquent;
use App\Repositories\AnswerRepositoryEloquent;
use App\Repositories\SubmitRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(QuizeRepository::class, QuizeRepositoryEloquent::class);
        $this->app->bind(QuestionRepository::class, QuestionRepositoryEloquent::class);
        $this->app->bind(AnswerRepository::class, AnswerRepositoryEloquent::class);
        $this->app->bind(SubmitRepository::class, SubmitRepositoryEloquent::class);
    }
}

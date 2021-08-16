<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\TransactionRepositoryInterface;
use App\Repositories\EloquentTransactionRepository;
use App\Repositories\CsvTransactionRepository;
use App\Services\TransactionService;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // bind transaction repository based on a GET param
        $this->app->when(TransactionService::class)
            ->needs(TransactionRepositoryInterface::class)
            ->give(function () {
                switch (request()->source) {
                    case 'csv':
                        return $this->app->get(CsvTransactionRepository::class);
                    case 'db':
                    default:
                        return $this->app->get(EloquentTransactionRepository::class);
                }
            });
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

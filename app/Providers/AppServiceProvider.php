<?php

namespace App\Providers;

use App\Actions\ArrangeProposalPositions;
use App\Contracts\ArrangesProposalPositions;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(ArrangesProposalPositions::class, ArrangeProposalPositions::class);
    }
}

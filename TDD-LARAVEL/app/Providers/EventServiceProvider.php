<?php

namespace App\Providers;

use App\Mail\PosAlteracaoDeSituacao;
use App\Models\Pos;
use App\Observer\PosObserver;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Pos::observe(PosObserver::class);
    }
}

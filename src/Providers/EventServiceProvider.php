<?php

namespace Aryanhasanzadeh\Voteing\Providers;

use Aryanhasanzadeh\Voteing\App\Models\Vote;
use Aryanhasanzadeh\Voteing\App\Observers\VoteObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider{


    protected $listen = [
        UserLoginActiveCodeEvent::class => [
            UserLoginActiveCodeListener::class
        ],
    ];


    public function boot()
    {
        Vote::observe(VoteObserver::class);
        parent::boot();
    }

}
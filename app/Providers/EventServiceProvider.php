<?php

namespace App\Providers;

use App\Events\OrderPlaced;
use App\Jobs\SendOrderConfirmationJob;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        OrderPlaced::class => [
            SendOrderConfirmationJob::class,
        ],
    ];
}

<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendOrderConfirmationJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(protected Order $order)
    {
        //
    }

    public function handle(): void
    {
        // Mock sending email — in real app use Mailables
        Log::info(
            'SendOrderConfirmationJob: order #' . $this->order->id . ' for provider ' . $this->order->provider_id
        );
        // e.g. Mail::to($this->order->provider->email)->send(new OrderConfirmation($this->order));
    }
}

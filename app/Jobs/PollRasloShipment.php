<?php

namespace App\Jobs;

use App\Services\Raslo\RasloWorker;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class PollRasloShipment implements ShouldQueue
{
    use Queueable;

    public int $tries = 1;

    public int $timeout = 60;

    public function __construct(public int $shipmentId) {}

    public function handle(RasloWorker $worker): void
    {
        $worker->poll($this->shipmentId);
    }
}

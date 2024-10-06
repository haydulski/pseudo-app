<?php

namespace App\Jobs;

use App\Helpers\WeatherService;
use App\Mail\Weather;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendWeatherEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private array $address)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $weather = new WeatherService();
        $forecast = $weather->getDailyTemperatureInfo();

        Mail::to($this->address['to'])
            ->cc($this->address['cc'])
            ->send(new Weather($forecast, $this->address['email'], $this->address['sender']));
    }
}

<?php

namespace App\Console\Commands;

use App\Jobs\SendWeatherEmail;
use Illuminate\Console\Command;

class WeatherEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:weather-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending email with weather information';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        SendWeatherEmail::dispatch([
            'email' => config('mail.weather.sender-email'),
            'sender' => config('mail.weather.sender'),
            'to' => config('mail.weather.to'),
            'cc' => explode('|', config('mail.weather.cc'))
        ]);
    }
}

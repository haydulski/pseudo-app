<?php

declare(strict_types=1);

namespace App\Helpers;

use DateTime;
use Illuminate\Support\Facades\Http;

class WeatherService
{

    private const URL = 'https://api.open-meteo.com/v1/forecast?';

    private const PARAMS = [
        "latitude" => 53.03,
        "longitude" => 23.6,
        "hourly" => "temperature_2m",
        "timezone" => "Europe/Warsaw",
        "forecast_days" => 1
    ];

    public function getDailyTemperatureInfo(): array
    {
        $endpoint = self::URL . http_build_query(self::PARAMS);
        $response = Http::get($endpoint);

        if ($response->successful()) {
            return $this->parseDailyTempData($response->json()['hourly']);
        }

        return ['Response of wheater API error'];
    }

    private function parseDailyTempData(array $data): array
    {
        $output = [];

        foreach ($data['time'] as $key => $time) {
            $output[] = (new DateTime($time))->format('H:i') . ' - ' . $data['temperature_2m'][$key] . '°C';
        }

        return $output;
    }
}

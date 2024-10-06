<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\SendWeatherEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RuntimeException;

class EmailController extends Controller
{

    public function index(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'password' => 'string|required'
            ]
        );

        if ($validated['password'] === config('mail.send-password')) {
            $cc = explode('|', config('mail.weather.cc'));

            SendWeatherEmail::dispatch(
                [
                    'email' => config('mail.weather.sender-email'),
                    'sender' => config('mail.weather.sender'),
                    'to' => config('mail.weather.to'),
                    'cc' => $cc
                ]
            );
        } else {
            throw new RuntimeException('Wrong email password');
        }

        return response()->redirectToRoute('home');
    }
}

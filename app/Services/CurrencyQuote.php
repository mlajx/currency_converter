<?php

namespace App\Services;

use App\Contracts\CurrencyQuoteContract;
use App\Exceptions\CurrencyQuoteException;
use Illuminate\Support\Facades\Http;

class CurrencyQuote implements CurrencyQuoteContract
{
    private $url;

    public function __construct()
    {
        $this->url = 'https://economia.awesomeapi.com.br/json/last/';
    }

    public function getQuote($base, $to): float
    {
        $response = Http::get($this->url . "$base-$to");

        if ($response->successful()) {
            return (float) $response->json()[$base . $to]['low'];
        }

        throw new CurrencyQuoteException();
    }
}

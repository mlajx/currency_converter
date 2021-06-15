<?php

namespace Tests\Feature;

use App\Models\CurrencyConverter;
use Tests\TestCase;

class APICurrencyConverterTest extends TestCase
{
    public function test_convert_success()
    {
        $base = 'USD';
        $to = 'BRL';
        $value = 2;

        $currencyConverter = CurrencyConverter::base($base)->to($to)->first();

        $response = $this->json('get', '/api/converter', ['base' => $base, 'to' => $to, 'value' => $value]);

        $response->assertExactJson([
            'value' => $value * $currencyConverter->value,
            'currency_quote' => $currencyConverter->value,
        ]);
    }

    public function test_convert_invalid_parameters()
    {
        $response = $this->json('get', '/api/converter', ['base' => 'usds', 'to' => 'mx', 'value' => 'abc']);

        $response->assertStatus(422);
    }
}

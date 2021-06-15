<?php

namespace Tests\Feature;

use App\Contracts\CurrencyQuoteContract;
use App\Models\CurrencyConverter;
use Mockery\MockInterface;
use Tests\TestCase;

class APICurrencyConverterTest extends TestCase
{
    public function test_convert_success()
    {
        $base = 'USD';
        $to = 'BRL';
        $value = 2;

        $currencyConverter = CurrencyConverter::base($base)->to($to)->first();

        $this->partialMock(CurrencyQuoteContract::class, function (MockInterface $mock) use ($currencyConverter) {
            $mock->shouldReceive('getQuote')->andReturn($currencyConverter->value);
        });

        $response = $this->json('get', '/api/converter', ['base' => $base, 'to' => $to, 'value' => $value]);

        $response->assertExactJson([
            'value' => $value * $currencyConverter->value,
            'currency_quote' => $currencyConverter->value,
        ]);
    }

    public function test_convert_same_base_and_to()
    {
        $base = 'USD';
        $to = 'USD';
        $value = 2;

        $response = $this->json('get', '/api/converter', ['base' => $base, 'to' => $to, 'value' => $value]);
        $response->assertExactJson([
            'value' => $value,
            'currency_quote' => 1,
        ]);
    }

    public function test_convert_invalid_parameters()
    {
        $response = $this->json('get', '/api/converter', ['base' => 'usds', 'to' => 'mx', 'value' => 'abc']);

        $response->assertStatus(422);
    }
}

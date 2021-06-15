<?php

namespace Database\Seeders;

use App\Models\CurrencyConverter;
use Illuminate\Database\Seeder;

class CurrencyConverterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->currencyConverterBRL();
        $this->currencyConverterUSD();
        $this->currencyConverterEUR();
    }

    private function currencyConverterBRL()
    {
        CurrencyConverter::create([
            'base' => 'BRL',
            'to' => 'EUR',
            'value' => 0.16,
        ]);

        CurrencyConverter::create([
            'base' => 'BRL',
            'to' => 'USD',
            'value' => 0.20,
        ]);
    }

    private function currencyConverterUSD()
    {
        CurrencyConverter::create([
            'base' => 'USD',
            'to' => 'BRL',
            'value' => 5.04,
        ]);

        CurrencyConverter::create([
            'base' => 'USD',
            'to' => 'EUR',
            'value' => 0.82,
        ]);
    }

    private function currencyConverterEUR()
    {
        CurrencyConverter::create([
            'base' => 'EUR',
            'to' => 'BRL',
            'value' => 6.11,
        ]);

        CurrencyConverter::create([
            'base' => 'EUR',
            'to' => 'USD',
            'value' => 1.21,
        ]);
    }
}

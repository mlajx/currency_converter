<?php

namespace App\Contracts;

interface CurrencyQuoteContract
{
    public function getQuote($base, $to): float;
}

<?php

namespace App\Http\Controllers\API;

use App\Contracts\CurrencyQuoteContract;
use App\Http\Controllers\Controller;
use App\Models\CurrencyConverter;
use App\Rules\Uppercase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class APICurrencyController extends Controller
{
    public function converter(Request $request, CurrencyQuoteContract $currencyQuote)
    {
        $payload = $request->only(['base', 'to', 'value']);

        Validator::validate($payload, [
            'base' => [
                'required',
                new Uppercase,
                Rule::in(['USD', 'BRL', 'EUR']),
            ],
            'to' => [
                'required',
                new Uppercase,
                Rule::in(['USD', 'BRL', 'EUR']),
            ],
            'value' => [
                'required',
                'numeric',
            ],
        ]);

        if ($payload['base'] == $payload['to']) {
            return response()->json([
                'value' => $payload['value'],
                'currency_quote' => 1,
            ]);
        }

        try {
            $currencyQuote = $currencyQuote->getQuote($payload['base'], $payload['to']);
        } catch (Exception $e) {
            $currencyQuote = CurrencyConverter::base($payload['base'])->to($payload['to'])->first()->value;
        }

        return response()->json([
            'value' => round($payload['value'] * $currencyQuote, 2),
            'currency_quote' => round($currencyQuote, 2),
        ]);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CurrencyConverter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class APICurrencyController extends Controller
{
    public function converter(Request $request)
    {
        $payload = $request->only(['base', 'to', 'value']);

        Validator::validate($payload, [
            'base' => [
                'required',
                Rule::in(['USD', 'BRL', 'EUR']),
            ],
            'to' => [
                'required',
                Rule::in(['USD', 'BRL', 'EUR']),
            ],
            'value' => [
                'required',
                'numeric',
            ],
        ]);

        $currencyConverter = CurrencyConverter::base($payload['base'])->to($payload['to'])->first();

        return response()->json([
            'value' => $payload['value'] * $currencyConverter->value,
            'currency_quote' => $currencyConverter->value,
        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrencyConverter extends Model
{
    public function scopeBase($query, $base)
    {
        return $query->where('base', $base);
    }

    public function scopeTo($query, $to)
    {
        return $query->where('to', $to);
    }
}

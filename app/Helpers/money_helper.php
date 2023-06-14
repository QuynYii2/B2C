<?php

use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;


if (!function_exists('convertCurrency')) {
    function convertCurrency($amount, $fromCurrency, $toCurrency)
    {
        $exchangeRates = app(ExchangeRate::class);
        $convertedAmountFormatted = $exchangeRates->convert($amount, $fromCurrency, $toCurrency, \Carbon\Carbon::now());

        return $convertedAmountFormatted;
    }
}

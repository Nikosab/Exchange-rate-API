<?php

function getExchangeRates() {
    $date = 'latest';
    $apiVersion = 'v1';
    $url = "https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@{$date}/{$apiVersion}/currencies.json";

    $response = file_get_contents($url);
    if ($response === FALSE) {
        die("Error fetching data.");
    }

    $exchangeRates = json_decode($response, true);

    return $exchangeRates;
}

echo "Enter amount and currency: ";
$input = trim(fgets(STDIN));
list($amount, $fromCurrency) = explode(" ", $input);

echo "Enter target currency: ";
$toCurrency = trim(fgets(STDIN));

$exchangeRates = getExchangeRates();

$result = convertCurrency($amount, strtoupper($fromCurrency), strtoupper($toCurrency), $exchangeRates);

echo "{$amount} {$fromCurrency} is equal to {$result} {$toCurrency}\n";
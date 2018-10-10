<?php

function rates($amount){
//We set EUR as our base currency.
$baseCurrency = 'ZAR';

//The API URL for our EURO to foreign currency exchange rates.
$apiUrl = "http://api.fixer.io/latest?base=$baseCurrency";

//Make the API call.
$content = file_get_contents($apiUrl);

//Make sure that the API call was successful before continuing.
if($content === false){
    throw new Exception('Unable to connect to API.');
}

//Decode the currency rates from JSON into an associative array.
$currencyRates = json_decode($content, true);

//Make sure that the JSON is valid before continuing.
if(!is_array($currencyRates)){
    throw new Exception('Unable to decode JSON.');
}

//In this case, we want the EURO to GBP exchange rate.
$gbpRate = $currencyRates['rates']['USD'];

//For this example, we are converting 5.50 EUR into Sterling.
$euros = $amount;

//To get the Sterling amount, simply multiply our EURO by the GBP exchange rate.
$gbp = $euros * $gbpRate;

//var_dump our float value for example purposes.
//var_dump($gbp);

//Print out the end result using PHP's number_format function.
return number_format($gbp, 2);
}
<?php

require_once 'CurrencyService.php';
require_once 'RateList.php';

class Exchange
{
    private $exchange;

    public function __construct($amount, string $currencyFrom, string $currencyTo, $date)
    {
        $this->exchange = (new CurrencyService($amount, $currencyFrom, $currencyTo, $date));
    }

    public function calculateExchange()
    {
        $rateList = new RateList($this->exchange);

        if (empty($rateList->getRateTo())){
            return round($this->exchange->getAmount() * $rateList->getRateFrom(), 2);
        }else{
            return round($this->exchange->getAmount() * $rateList->getRateFrom() / $rateList->getRateTo(), 2);
        }
    }
}
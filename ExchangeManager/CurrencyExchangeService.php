<?php

require_once 'CurrencyExchangeDTO.php';
require_once 'RateList.php';

class CurrencyExchangeService
{

    public function calculateExchange( CurrencyExchangeDTO $currencyExchangeDTO, RateList $rateList)
    {
            return round($currencyExchangeDTO->getAmount() * $rateList->getRateFrom() / $rateList->getRateTo(), 2);
    }
}
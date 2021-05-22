<?php

require_once 'CurrencyExchangeDTO.php';
require_once 'NBUapi.php';
require_once 'Rate.php';

class NBUapiService
{
    public function getRateFrom(CurrencyExchangeDTO $currencyExchangeDTO, NBUapi $NBUapi) : Rate
    {
        $properties = $NBUapi->getRate($currencyExchangeDTO->getCurrencyFrom(), $currencyExchangeDTO->getDate());
        return new Rate($properties);
    }

    public function getRateTo(CurrencyExchangeDTO $currencyExchangeDTO, NBUapi $NBUapi) : Rate
    {
        $properties = $NBUapi->getRate($currencyExchangeDTO->getCurrencyTo(), $currencyExchangeDTO->getDate());
        return new Rate($properties);
    }
}
<?php

require_once 'CurrencyExchangeService.php';
$curencyExchangeDTO = new CurrencyExchangeDTO($_REQUEST['amount'], $_REQUEST['currencyFrom'],
    $_REQUEST['currencyTo'], $_REQUEST['date'] );

$rateList = new RateList($curencyExchangeDTO);

$exchangeService = new CurrencyExchangeService();


echo $_REQUEST['amount'] .' '. $_REQUEST['currencyFrom'] . ' = ' .
    $exchangeService->calculateExchange($curencyExchangeDTO, $rateList) .
    ' ' .$_REQUEST['currencyTo'];







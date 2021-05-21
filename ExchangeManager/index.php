<?php

require_once 'Exchange.php';

$exchange = new Exchange($_REQUEST['amount'], $_REQUEST['currencyFrom'], $_REQUEST['currencyTo'], $_REQUEST['date'] );

echo $_REQUEST['amount'] .' '. $_REQUEST['currencyFrom'] . ' = ' .  $exchange->calculateExchange() . ' ' .$_REQUEST['currencyTo'];







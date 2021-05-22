<?php

class CurrencyExchangeDTO
{
    private $amount;
    private $currencyFrom;
    private $currencyTo;
    private $date;

    public function __construct(float $amount, string $currencyFrom, string $currencyTo, $date)
    {
        if (iconv_strlen($currencyFrom) == 3 && strlen($currencyTo) == 3){
            $this->currencyFrom = strtoupper(trim($currencyFrom));
            $this->currencyTo = strtoupper(trim($currencyTo));
        }
        $this->date = $date;
        $this->amount = $amount;

    }

    /**
     * @return string
     */
    public function getCurrencyFrom(): string
    {
        return $this->currencyFrom;
    }

    /**
     * @return string
     */
    public function getCurrencyTo(): string
    {
        return $this->currencyTo;
    }

    /**
     * @return string
     */
    public function getDate() : string
    {
        return $this->date;
    }

    /**
     * @return float
     */
    public function getAmount() : float
    {
        return $this->amount;
    }




}
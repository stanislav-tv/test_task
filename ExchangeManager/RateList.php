<?php

require_once 'CurrencyExchangeDTO.php';
require_once 'NBUapi.php';
require_once 'NBUapiService.php';
require_once 'RateNullObject.php';

class RateList
{
    private $rateTo ;
    private $rateFrom;

    public function __construct(
        CurrencyExchangeDTO $currencyExchangeDTO
    )
    {
        $this->build($currencyExchangeDTO);
    }

    public function getRateFrom() : float
    {
        return $this->rateFrom->getRate();
    }

    public function getRateTo() : float
    {
        return $this->rateTo->getRate();
    }


    private function build(CurrencyExchangeDTO $currencyExchangeDTO)
    {
        $nbu = new NBUapi();
        $NBUapiService = new NBUapiService();

        $this->rateFrom = $NBUapiService->getRateFrom($currencyExchangeDTO, $nbu);

        if ($this->isCurrencyToUAH($currencyExchangeDTO->getCurrencyTo())){
            $rateNull = new RateNullObject();
            $rateNull->setNullRate();
            $this->rateTo = $rateNull;
        }else{
            $this->rateTo = $NBUapiService->getRateTo($currencyExchangeDTO, $nbu);
        }
    }

    private function isCurrencyToUAH(string $checkCurrency) : bool
    {
        if ($checkCurrency == 'UAH'){
            return true;
        }else{
            return false;
        }
    }
}
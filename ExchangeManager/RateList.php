<?php

require_once 'Rate.php';
require_once 'NBUapi.php';

class RateList
{
    private $currencyService;
    private $rateTo = NULL;
    private $rateFrom;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
        $this->generateRateList();
    }

    /**
     * @return mixed
     */
    public function getRateFrom()
    {
        return $this->rateFrom;
    }

    public function getRateTo()
    {
        return $this->rateTo;
    }

    private function generateRateList()
    {

        if ($this->isCurrencyToUAH()){
            $this->rateFrom = (new Rate(new NBUapi($this->currencyService->getCurrencyFrom(), $this->currencyService->getDate())))->getRate();
        }else{
            $this->rateFrom = (new Rate(new NBUapi($this->currencyService->getCurrencyFrom(), $this->currencyService->getDate())))->getRate();
            $this->rateTo = (new Rate(new NBUapi($this->currencyService->getCurrencyTo(), $this->currencyService->getDate())))->getRate();

        }
    }

    private function isCurrencyToUAH() : bool
    {

        if ($this->currencyService->getCurrencyTo() == 'UAH'){
            return true;
        }else{
            return false;
        }
    }


}
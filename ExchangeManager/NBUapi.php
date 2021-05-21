<?php


class NBUapi
{
    private $url = 'https://bank.gov.ua/NBUStatService/v1/statdirectory/exchangenew?json';
    private $currency_enpoint = '&valcode=';
    private $time_endpoint = '&date=';
    private $currency;
    private $time;

    public function __construct(string $currency, string $time)
    {
        $this->currency = $currency;
        $this->time = $time;
    }

    public function getRate() : array
    {
        $curl = curl_init($this->generateUrl());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        return json_decode(curl_exec($curl), true)[0];
    }

    private function generateUrl() : string
    {
        $time = implode('', explode('-', substr($this->time, 0,10)));
        return $this->url . $this->currency_enpoint . $this->currency . $this->time_endpoint . $time;
    }





}
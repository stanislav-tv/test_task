<?php


class NBUapi
{
    private $url = 'https://bank.gov.ua/NBUStatService/v1/statdirectory/exchangenew?json';
    private $currency_enpoint = '&valcode=';
    private $time_endpoint = '&date=';


    public function getRate(string $currency, string $date) : array
    {
        $curl = curl_init($this->generateUrl($currency, $date));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        return json_decode(curl_exec($curl), true)[0];
    }

    private function generateUrl($currency, $date) : string
    {
        $format_date = implode('', explode('-', substr($date, 0,10)));
        return $this->url . $this->currency_enpoint . $currency . $this->time_endpoint . $format_date;
    }





}
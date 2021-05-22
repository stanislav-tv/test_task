<?php


class RateNullObject
{
    private $id;
    private $title;
    private $rate;
    private $currencyCode;
    private $date;

    public function setNullRate()
    {
        $this->id = null;
        $this->title = null;
        $this->rate = 1;
        $this->currencyCode = null;
        $this->date = null;
    }

    public function getRate()
    {
        return $this->rate;
    }
}
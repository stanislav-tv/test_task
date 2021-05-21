<?php


class Rate
{
    private $id;
    private $title;
    private $rate;
    private $currencyCode;
    private $date;

    private $nbu;

    public function __construct(NBUapi $nbu)
    {
        $this->nbu = $nbu;
        $this->parserProperties();
    }

    private function parserProperties()
    {
        $properties = $this->nbu->getRate();
        $this->id = $properties['r030'];
        $this->title = $properties['txt'];
        $this->rate = $properties['rate'];
        $this->currencyCode = $properties['cc'];
        $this->date = $properties['exchangedate'];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @return mixed
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }
}
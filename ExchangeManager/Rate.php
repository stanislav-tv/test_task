<?php


class Rate
{
    protected $id;
    protected $title;
    protected $rate;
    protected $currencyCode;
    protected $date;

    public function __construct(array $properties)
    {
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
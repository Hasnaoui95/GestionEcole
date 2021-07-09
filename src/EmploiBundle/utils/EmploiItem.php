<?php

namespace EmploiBundle\utils;

class EmploiItem {

    private $monday;
    private $tuesday;
    private $wednesday;
    private $thursday;
    private $friday;
    private $saturday;

    private $jour;
    private $detail;

    /**
     * EmploiItem constructor.
     */
    public function __construct()
    {
    }


    /**
     * @return mixed
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * @return mixed
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @param mixed $jour
     */
    public function setJour($jour)
    {
        $this->jour = $jour;
    }

    /**
     * @param mixed $detail
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;
    }

    /**
     * @return mixed
     */
    public function getMonday()
    {
        return $this->monday;
    }

    /**
     * @return mixed
     */
    public function getTuesday()
    {
        return $this->tuesday;
    }

    /**
     * @return mixed
     */
    public function getWednesday()
    {
        return $this->wednesday;
    }

    /**
     * @return mixed
     */
    public function getThursday()
    {
        return $this->thursday;
    }

    /**
     * @return mixed
     */
    public function getFriday()
    {
        return $this->friday;
    }

    /**
     * @return mixed
     */
    public function getSaturday()
    {
        return $this->saturday;
    }

    /**
     * @param mixed $monday
     */
    public function setMonday($monday)
    {
        $this->monday = $monday;
    }

    /**
     * @param mixed $tuesday
     */
    public function setTuesday($tuesday)
    {
        $this->tuesday = $tuesday;
    }

    /**
     * @param mixed $wednesday
     */
    public function setWednesday($wednesday)
    {
        $this->wednesday = $wednesday;
    }

    /**
     * @param mixed $thursday
     */
    public function setThursday($thursday)
    {
        $this->thursday = $thursday;
    }

    /**
     * @param mixed $friday
     */
    public function setFriday($friday)
    {
        $this->friday = $friday;
    }

    /**
     * @param mixed $saturday
     */
    public function setSaturday($saturday)
    {
        $this->saturday = $saturday;
    }


}

?>
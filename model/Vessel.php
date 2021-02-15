<?php

namespace model;

/**
* @param coords : define the position of vesset on the map
*/
Abstract class Vessel {

    private $order;
    private $coords = [0,0];

    public function __construct($coords = [0,0]){
        $this->move($coords);
    }

    abstract function doOrder($order);

    public function move($coords){
        $this->coords = $coords;
    }

    public function getH(): int{
        return $this->coords[0];
    }

    public function getW(): int{
        return $this->coords[1];
    }

}

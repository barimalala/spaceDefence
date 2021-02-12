<?php

namespace model;

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

    public function getH(){
        return $this->coords[0];
    }

    public function getW(){
        return $this->coords[1];
    }

}

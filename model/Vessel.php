<?php

namespace model;

Abstract class Vessel {

    private $order;
    private $coords = [0,0];

    public function __construct($coords = [0,0]){
        $this->move($coords);
    }

    abstract function doOrder($order);

    function move($coords){
        $this->coords = $coords;
    }

}

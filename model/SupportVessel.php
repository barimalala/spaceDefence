<?php

namespace model;

require_once('Vessel.php');

class SupportVessel extends Vessel{

    const REFUELER = 'refueler';
    const MECHANICAL = 'mechanical';
    const CARGO = 'cargo';

    public function __construct($type = self::REFUELER ,$coords = [0,0]){

        if(!in_array($type,[self::REFUELER,self::MECHANICAL,self::CARGO]))
            throw new Exception('the support vessel requested does not exist yet!');

        Parent::__construct($coords);
    }

    function doOrder($order, &$target = null){

    }
}
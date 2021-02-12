<?php

namespace model;

require_once('Vessel.php');

class OffensivesVessel extends \model\Vessel{
    
    const BATTELSHIPS = 'battelships';
    const DESTROYER = 'destroyers';
    const CRUISERS = 'cruisers';

    protected $cannon = 0;


    public function __construct($type = self::BATTELSHIPS ,$coords = [0,0]){

        if(!in_array($type,[self::BATTELSHIPS,self::DESTROYER,self::CRUISERS]))
            throw new Exception('the offensive vessel requested does not exist yet!');

            switch ($type) {
                case self::BATTELSHIPS:
                    $this->cannon = 24;
                    break;
                case self::DESTROYER:
                    $this->cannon = 12;
                    break;
                case self::CRUISERS:
                    $this->cannon = 6;
                    break;
            }

        Parent::__construct($coords);
    }

    function doOrder($order, &$target = null){

    }
}
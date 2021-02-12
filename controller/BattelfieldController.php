<?php

namespace controller;

require_once('.\model\Fleet.php');

class BattelfieldController{

    public $areaHeight = 100;
    public $areaWeight = 100;
    public $Fleets = [];

    public function __construct(int $areaHeight, int $areaWeight){
        if( $areaHeight > 100 || $areaWeight > 100){
            throw new \Exception('Choose another dimention less than 100x100 !');
        }
        $this->areaHeight = $areaHeight;
        $this->areaWeight = $areaWeight;
    }

    public function subscribeFleet(Fleet $Fleet){

        if(!count($Fleet->getVessels()))
            throw new \Exception('you can\'t subscribe an empty fleet');
        if($this->evaluateSpaceLeft()<count($Fleet->getVessels()))
            throw new \Exception('you can\'t substribe this fleet because there hasn\'t place left!');

        $this->Fleets[] = $Fleet;
    }

    private function evaluateSpaceLeft(){
        $totalSpace = $this->areaHeight * $this->areaWeight;
        foreach ($this->Fleets as $Fleet) {
            $totalSpace -= count($Fleet->getVessels());
        }

        return $totalSpace;
    }

    public function getBattleArea(){
        $initRange = \array_map(function(){
            return array_fill(0,$this->areaHeight,0);
        },array_fill(0,$this->areaHeight,0));
        return $initRange;
    }
}
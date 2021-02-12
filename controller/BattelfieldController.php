<?php

namespace controller;

require_once('.\model\Fleet.php');
require_once('.\model\OffensivesVessel.php');
require_once('.\model\SupportVessel.php');

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

    public function subscribeFleet(\model\Fleet $Fleet){

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
        $area = \array_map(function(){
            return array_fill(0,$this->areaHeight,0);
        },array_fill(0,$this->areaHeight,0));

        foreach ($this->Fleets as $key => $fleet) {
            foreach ($fleet->vessels as $key => $vessel) {
                $area[$vessel->getH()][$vessel->getW()]=1;
            }
        }
        return $area;
    }

    public function setVesselOnMapRandom(){

        $occupedRows = [];

        foreach ($this->Fleets as $key => $fleet) {
            foreach ($fleet->vessels as $key => &$vessel) {
                if(count($occupedRows) >= $this->areaHeight * $this->areaWeight -1){
                    throw new \Exception("There is no more place left !");
                }
                do {
                    $havePlace = false;
                    $h = \rand(0,$this->areaHeight);
                    $w = \rand(0,$this->areaWeight);
                    $search = 'H'.$h.'W'.$w;

                    if(!in_array($search,$occupedRows)){
                        $vessel->move([$h,$w]);
                        $occupedRows[]=$search;
                        $havePlace = true;
                    }
                } while (!$havePlace);
            }
        }
    }
    
    
    public function generateOffensiveVessels($number = 50, $type = null){
        $vessels = [];
        for ($i=0; $i < 50; $i++) { 
            $vessels[] = new \model\OffensivesVessel();
        }
        return $vessels;
    }

    public function createFleet(array $vessels){
        $Fleet = new \model\Fleet($vessels);
        $this->subscribeFleet($Fleet); 
    }
}
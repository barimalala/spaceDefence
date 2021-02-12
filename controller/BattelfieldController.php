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
                $area[$vessel->getH()][$vessel->getW()]= $vessel instanceof \model\OffensivesVessel ? 1 : 2;
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
    
    public function setVesselAdjacentOnMap(){
        $occupedRows = [];
        foreach ($this->Fleets as $key => $fleet) {
            $supportVessels = $this->extractSupportVaissel($fleet);
            $currentSupportPlacedIndex=0;

            foreach ($fleet->vessels as $key => &$vessel) {
                if(count($occupedRows) >= $this->areaHeight * $this->areaWeight -1){
                    throw new \Exception("There is no more place left !");
                }
                if($vessel instanceof \model\OffensivesVessel){
                    do {
                        $havePlace = false;
                        $h = \rand(0,$this->areaHeight);
                        $w = \rand(0,$this->areaWeight);
                        $search = 'H'.$h.'W'.$w;
    
                        if(!in_array($search,$occupedRows) && $adj = $this->findAdjacentFreeCase($h,$w,$occupedRows)){
                            $vessel->move([$h,$w]);
                            $occupedRows[]=$search;

                            $randAdjacentIndex = array_rand($adj);
                            $sH = $adj[$randAdjacentIndex][0];
                            $sW = $adj[$randAdjacentIndex][1];
                            $supportVessels[$currentSupportPlacedIndex]->move([$sH,$sW]);
                            $occupedRows[]='H'.$sH.'W'.$sW;

                            $havePlace = true;
                            $currentSupportPlacedIndex++;
                        }
                    } while (!$havePlace);
                }
            }
        }
    }

    private function extractSupportVaissel($fleet) : array {
        $supportVessels = [];
        for ($i=0; $i < \count($fleet->vessels) ; $i++) { 
            if($fleet->vessels[$i] instanceof \model\SupportVessel){
                $supportVessels[] = $fleet->vessels[$i];
            }
        }
        return $supportVessels;
    }

    private function findAdjacentFreeCase($h,$w,$occupedRows) : array{
        $adj = [];
        for ($i=-1; $i <= 1; $i++) { 
            for ($j=-1; $j <= 1; $j++) { 
                if(
                    ( $i!=0 || $j!=0 )
                    && ( $h + $i >= 0 )
                    && ( $h + $i <= $this->areaHeight)
                    && ( $w + $j >= 0 )
                    && ( $w + $j <= $this->areaWeight)
                    && !in_array('H'.($h+$i).'W'.($w+$j),$occupedRows)
                ){
                    $adj[]=[$h+$i,$w+$j];
                }
            }
        }
        return $adj;
    }
    
    public function generateOffensiveVessels($number = 50, $type = null){
        $vessels = [];
        for ($i=0; $i < $number; $i++) { 
            $vessels[] = new \model\OffensivesVessel();
        }
        return $vessels;
    }

    public function generateSupportVessel($number = 50, $type = null){
        $vessels = [];
        for ($i=0; $i < $number; $i++) { 
            $vessels[] = new \model\SupportVessel();
        }
        return $vessels;
    }

    public function createFleet(array $vessels){
        $Fleet = new \model\Fleet($vessels);
        $this->subscribeFleet($Fleet); 
    }
}
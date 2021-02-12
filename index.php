<?php
require('controller/BattelfieldController.php');

$BattelfieldController = new \controller\BattelfieldController(20,20);

$area = $BattelfieldController->getBattleArea();

$OffensiveVessels = $BattelfieldController->generateOffensiveVessels();
$BattelfieldController->createFleet($OffensiveVessels);
$BattelfieldController->setVesselOnMapRandom();
echo count($BattelfieldController->Fleets);
$area = $BattelfieldController->getBattleArea();

for ($i=0; $i < $BattelfieldController->areaHeight; $i++) { 
    for ($j=0; $j < $BattelfieldController->areaWeight; $j++) { 
        echo '|'.$area[$i][$j].'|';
    }
    var_dump('');
}
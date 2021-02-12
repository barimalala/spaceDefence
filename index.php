<?php
require('controller/BattelfieldController.php');

$BattelfieldController = new \controller\BattelfieldController(20,20);

$area = $BattelfieldController->getBattleArea();

$OffensiveVessels = $BattelfieldController->generateOffensiveVessels(25);
$SupportVessel = $BattelfieldController->generateSupportVessel(25);

$BattelfieldController->createFleet(array_merge($SupportVessel,$OffensiveVessels));

// $BattelfieldController->setVesselOnMapRandom();
$BattelfieldController->setVesselAdjacentOnMap();
$area = $BattelfieldController->getBattleArea();

for ($i=0; $i < $BattelfieldController->areaHeight; $i++) { 
    for ($j=0; $j < $BattelfieldController->areaWeight; $j++) { 
        echo '|'.$area[$i][$j].'|';
    }
    var_dump('');
}
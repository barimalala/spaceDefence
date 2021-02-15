<?php
require('controller/BattelfieldController.php');
/**
* create a new battelfield area
*/
$BattelfieldController = new \controller\BattelfieldController(20,20);

/**
* compose the enemy vessels
*/
$enemyVessels = $BattelfieldController->generateOffensiveVessels(50);
$BattelfieldController->createFleet($enemyVessels);

/**
* compose our vessels
*/
$OffensiveVessels = $BattelfieldController->generateOffensiveVessels(25);
$SupportVessel = $BattelfieldController->generateSupportVessel(25);
$BattelfieldController->createFleet(array_merge($SupportVessel,$OffensiveVessels));

/**
* place all vessels on maps
*/
$BattelfieldController->setVesselAdjacentOnMap();

/**
* generate the area
* all offensive vessel is represented by a even number, and odd for support
* 0 when empty case
*/ 
$area = $BattelfieldController->getBattleArea();


for ($i=0; $i < $BattelfieldController->areaHeight; $i++) { 
    for ($j=0; $j < $BattelfieldController->areaWeight; $j++) { 
        echo '|'.$area[$i][$j].'|';
    }
    //just to force put in line on console
    var_dump('');
}
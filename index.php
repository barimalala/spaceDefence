<?php
require('model/Fleet.php');
require('model/OffensivesVessel.php');
require('model/SupportVessel.php');
require('controller/BattelfieldController.php');

$OffensiveVessel = new \model\OffensivesVessel();
$SupporVessel = new \model\SupportVessel();


$BattelfieldController = new \controller\BattelfieldController(20,20);

$area = $BattelfieldController->getBattleArea();

for ($i=0; $i < $BattelfieldController->areaHeight; $i++) { 
    for ($j=0; $j < $BattelfieldController->areaWeight; $j++) { 
        echo '|'.$area[$i][$j].'|';
    }
    var_dump('');
}
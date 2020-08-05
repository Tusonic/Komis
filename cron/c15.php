<?php
require_once '../config/loader.php';
spl_autoload_register('loader::loaderDir');

ob_start();
session_start();

// sekcja 1 - cron // 
$car = 'car15';
$idcar = 15;

echo $idcar;
  echo $car;


$cron = new cron();

$cron->CronOtomoto($idcar,$car);
$cron->CronOlx($idcar,$car);
$cron->CronOlxPremium($idcar,$car);


    ?>
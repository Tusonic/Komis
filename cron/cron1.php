<?php
require_once '../config/loader.php';
spl_autoload_register('loader::loaderDir');

ob_start();
session_start();

// sekcja 1 - cron // 
$car = 'car';
$cron = new cron();
$cron->CronOtomoto(1,$car);
$cron->CronOlx(1,$car);
$cron->CronOlxPremium(1,$car)

    ?>
<?php
require_once '../config/loader.php';
spl_autoload_register('loader::loaderDir');

ob_start();
session_start();

// sekcja 1 - cron // 
$car1 = 'car1';
$car2 = 'car2';
$car3 = 'car3';


$cron = new cron();

$cron->CronOtomoto(4,$car1);
$cron->CronOlx(4,$car1);
$cron->CronOlxPremium(4,$car1);

$cron->CronOtomoto(5,$car2);
$cron->CronOlx(5,$car2);
$cron->CronOlxPremium(5,$car2);

$cron->CronOtomoto(6,$car3);
$cron->CronOlx(6,$car3);
$cron->CronOlxPremium(6,$car3);

    ?>
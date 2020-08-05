<?php
require_once '../config/loader.php';
spl_autoload_register('loader::loaderDir');

ob_start();
session_start();

// sekcja - cron // 
$car = 'car27';

$cron = new cron();

$cron->CronOtomoto(27,$car);
$cron->CronOlx(27,$car);
$cron->CronOlxPremium(27,$car);


    ?>
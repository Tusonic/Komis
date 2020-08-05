<?php
require_once '../config/loader.php';
spl_autoload_register('loader::loaderDir');

ob_start();
session_start();

// sekcja - cron // 
$car15 = 'car15';

$cron = new cron();

$cron->CronOtomoto(15,$car15);
$cron->CronOlx(15,$car15);
$cron->CronOlxPremium(15,$car15);


    ?>
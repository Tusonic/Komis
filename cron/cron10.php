<?php
require_once '../config/loader.php';
spl_autoload_register('loader::loaderDir');

ob_start();
session_start();

// sekcja - cron // 
$car10 = 'car10';

$cron = new cron();

$cron->CronOtomoto(10,$car10);
$cron->CronOlx(10,$car10);
$cron->CronOlxPremium(10,$car10);


    ?>
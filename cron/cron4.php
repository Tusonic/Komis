<?php
require_once '../config/loader.php';
spl_autoload_register('loader::loaderDir');

ob_start();
session_start();

// sekcja 12 - 16 - cron // 

$car12 = 'car12';
$car13 = 'car13';
$car14 = 'car14';
$car15 = 'car15';
$car16 = 'car16';

$cron = new cron();

$cron->CronOtomoto(12,$car12);
$cron->CronOlx(12,$car12);
$cron->CronOlxPremium(12,$car12);

$cron->CronOtomoto(13,$car13);
$cron->CronOlx(13,$car13);
$cron->CronOlxPremium(13,$car13);

$cron->CronOtomoto(14,$car14);
$cron->CronOlx(14,$car14);
$cron->CronOlxPremium(14,$car14);

$cron->CronOtomoto(15,$car15);
$cron->CronOlx(15,$car15);
$cron->CronOlxPremium(15,$car15);

$cron->CronOtomoto(16,$car16);
$cron->CronOlx(16,$car16);
$cron->CronOlxPremium(16,$car16);


    ?>
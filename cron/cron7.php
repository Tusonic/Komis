<?php
require_once '../config/loader.php';
spl_autoload_register('loader::loaderDir');

ob_start();
session_start();

// sekcja 27 - 29 - cron // 
$car27 = 'car27';
$car28 = 'car28';
$car29 = 'car29';

$cron = new cron();

$cron->CronOtomoto(27,$car27);
$cron->CronOlx(27,$car27);
$cron->CronOlxPremium(27,$car27);

$cron->CronOtomoto(28,$car28);
$cron->CronOlx(28,$car28);
$cron->CronOlxPremium(28,$car28);

$cron->CronOtomoto(29,$car29);
$cron->CronOlx(29,$car29);
$cron->CronOlxPremium(29,$car29);

    ?>
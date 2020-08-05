<?php
require_once '../config/loader.php';
spl_autoload_register('loader::loaderDir');

ob_start();
session_start();

// sekcja 17 - 21 - cron // 

$car17 = 'car17';
$car18 = 'car18';
$car19 = 'car19';
$car20 = 'car20';
$car21 = 'car21';

$cron = new cron();

$cron->CronOtomoto(17,$car17);
$cron->CronOlx(17,$car17);
$cron->CronOlxPremium(17,$car17);

$cron->CronOtomoto(18,$car18);
$cron->CronOlx(18,$car18);
$cron->CronOlxPremium(18,$car18);

$cron->CronOtomoto(19,$car19);
$cron->CronOlx(19,$car19);
$cron->CronOlxPremium(19,$car19);

$cron->CronOtomoto(20,$car20);
$cron->CronOlx(20,$car20);
$cron->CronOlxPremium(20,$car20);

$cron->CronOtomoto(21,$car21);
$cron->CronOlx(21,$car21);
$cron->CronOlxPremium(21,$car21);

    ?>
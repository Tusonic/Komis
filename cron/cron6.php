<?php
require_once '../config/loader.php';
spl_autoload_register('loader::loaderDir');

ob_start();
session_start();

// sekcja 22 - 26 - cron // 

$car22 = 'car22';
$car23 = 'car23';
$car24 = 'car24';
$car25 = 'car25';
$car26 = 'car26';

$cron = new cron();

$cron->CronOtomoto(22,$car22);
$cron->CronOlx(22,$car22);
$cron->CronOlxPremium(22,$car22);

$cron->CronOtomoto(23,$car23);
$cron->CronOlx(23,$car23);
$cron->CronOlxPremium(23,$car23);

$cron->CronOtomoto(24,$car24);
$cron->CronOlx(24,$car24);
$cron->CronOlxPremium(24,$car24);

$cron->CronOtomoto(25,$car25);
$cron->CronOlx(25,$car25);
$cron->CronOlxPremium(25,$car25);

$cron->CronOtomoto(26,$car26);
$cron->CronOlx(26,$car26);
$cron->CronOlxPremium(26,$car26);

    ?>
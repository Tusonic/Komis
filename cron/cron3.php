<?php
require_once '../config/loader.php';
spl_autoload_register('loader::loaderDir');

ob_start();
session_start();

// sekcja 7 - 11 - cron // 
$car7 = 'car7';
$car8 = 'car8';
$car9 = 'car9';
$car10 = 'car10';
$car11 = 'car11';

$cron = new cron();

$cron->CronOtomoto(7,$car7);
$cron->CronOlx(7,$car7);
$cron->CronOlxPremium(7,$car7);

$cron->CronOtomoto(8,$car8);
$cron->CronOlx(8,$car8);
$cron->CronOlxPremium(8,$car8);

$cron->CronOtomoto(9,$car9);
$cron->CronOlx(9,$car9);
$cron->CronOlxPremium(9,$car9);

$cron->CronOtomoto(10,$car10);
$cron->CronOlx(10,$car10);
$cron->CronOlxPremium(10,$car10);

$cron->CronOtomoto(11,$car11);
$cron->CronOlx(11,$car11);
$cron->CronOlxPremium(11,$car11);

    ?>
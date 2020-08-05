<?php
require_once '../config/loader.php';
spl_autoload_register('loader::loaderDir');

ob_start();
session_start();

// sekcja - cron // 
$car17 = 'car17';

$cron = new cron();

$cron->CronOtomoto(17,$car17);
$cron->CronOlx(17,$car17);
$cron->CronOlxPremium(17,$car17);


    ?>
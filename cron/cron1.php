<?php
require_once '../config/loader.php';
spl_autoload_register('loader::loaderDir');

ob_start();
session_start();

// sekcja 1 - cron // 
$car = 'car';
$cron = new cron();
$cron->cron1otomoto(1,$car);
$cron->cron1olx(1,$car);
$cron->cron1olxpremium(1,$car)

    ?>
<?php

require_once '../config/loader.php';
spl_autoload_register('loader::loaderDir');

ob_start();
session_start();

$site = new viewsite();
$car = new car();
$information = new information();

if (isset($_SESSION['access'])) {
    if ($_SESSION['access'] >= 1) {
        if ($_SESSION['flag'] == 0) {
            $site->StartHead();
            $site->BackMenu();
            $car->EXPORT_DATABASE('127.0.0.1','komis','komis','komis',array('car'),false);
            $site->EndHead();
        } elseif ($_SESSION['flag'] == 1) {
            $site->StartHead();
            $site->BackMenu();
            $information->WaitChange();
            $site->EndHead();
        }
    } else {
        $site->Error();
    }
} else {
    $site->Error();
}

ob_end_flush();
?>
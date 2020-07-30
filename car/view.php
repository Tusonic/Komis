<?php
require_once '../config/loader.php';
spl_autoload_register('loader::loaderDir');

ob_start();
session_start();

$site = new viewsite();
$car = new car();


if (isset($_SESSION['access'])) {
    if ($_SESSION['access'] >= 1) {
        if ($_SESSION['flag'] == 0) {
            $tablecar = $_SESSION['tablecar'];
            $site->starthead();
            $site->backmenu();
            $car->viewoptions();
            $car->view($tablecar);
            $site->endhead();
        } else {
            $tablecar = $_SESSION['tablecar'];
            $site->starthead();
            $site->backmenu();

            $car->waitchange2();
            $car->view($tablecar);
            $site->endhead();
        }
    } else {
        $site->error();
    }
} else {
    $site->error();
}


ob_end_flush();
?>
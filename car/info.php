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
        if ($_SESSION['flag'] == 0) 
           {
            $site->starthead();
            $site->backmenu();
            $car->viewoptions();
            $car->info();
            $site->endhead();
           }
        elseif ($_SESSION['flag'] == 2) 
            {
            $site->starthead();
            $site->backmenu();
            $information->StartUserMenu();
            $site->endhead();
            }
          else 
            {
            $site->starthead();
            $site->backmenu();
            $information->waitchange();
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
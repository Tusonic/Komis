<?php
require_once 'config/loader.php';
spl_autoload_register('loader::loaderRoot');

ob_start();
session_start();

$site = new viewsite();
$information = new information();

if (isset($_SESSION['access'])) {
    if ($_SESSION['flag'] == '0') {
        $site->StartHead();
        $site->Login();
        $site->EndHead();
    } elseif ($_SESSION['flag'] == '2') {
        $site->StartHead();
        $site->Login();
        $information->StartUserMenu();
        $site->EndHead();
    } else {
        $site->StartHead();
        $site->Login();
        $site->EndHead();
    }
}
else{
    $site->StartHead();
    $site->Login();
    $site->EndHead();
}


ob_end_flush();
?>
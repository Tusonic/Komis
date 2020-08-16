<?php
require_once '../config/loader.php';
spl_autoload_register('loader::loaderDir');

ob_start();
session_start();

$site = new viewsite();
$admin = new admin();

if (isset($_SESSION['access'])) {
    if ($_SESSION['access'] == 3) {

        $site->starthead();
        $site->backmenu();
        $admin->ChangePasswordDataExecute();
        $site->endhead();

    }

else
    {
        $site->error();
    }
}

else
    {
        $site->error();
    }

ob_end_flush();
?>
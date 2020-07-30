<?php
session_start();

//unset ($_SESSION['login_in']);
//unset ($_SESSION['login']);
//unset ($_SESSION['password']);
//unset ($_SESSION['access']);

session_unset();
session_destroy();


header('Location: http://127.0.0.1');
exit;


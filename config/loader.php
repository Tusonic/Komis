<?php

class loader
{
    public static function loaderroot($className)
    {

        $filename = './class/' . $className . '.class.php';
        require_once($filename);

    }

    public static function loaderdir($className)
    {

        $filename = '../class/' . $className . '.class.php';
        require_once($filename);

    }


}
?>
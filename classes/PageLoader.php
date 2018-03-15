<?php
/**
 * Created by PhpStorm.
 * User: Lucien
 * Date: 14/03/2018
 * Time: 08:50
 */

class PageLoader
{
    public static function load(String $page) : void {
        $page = "./includes/" . $page . ".inc.php";

        $files = glob("./includes/*.inc.php");

        if (in_array($page, $files))
            include $page;
        else
            include "./includes/home.inc.php";
    }
}
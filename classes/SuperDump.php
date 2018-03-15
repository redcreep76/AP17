<?php
/**
 * Created by PhpStorm.
 * User: Lucien
 * Date: 14/03/2018
 * Time: 16:03
 */

class SuperDump
{

    public static function dump($data) {
        echo "<pre>";
        if (is_array($data)) {
            echo htmlentities(print_r($data));
        } else {
            echo htmlentities($data);
        }
        echo "</pre>";
    }
}
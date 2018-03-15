<?php

class Redirection
{
    public static function redirect($url) {
        echo "<script type='text/javascript'>";
        echo "window.location.replace('$url');";
        echo "</script>";
    }
}
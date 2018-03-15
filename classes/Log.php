<?php

class Log
{
    public static function logWrite($data)
    {
        $directory = dirname(__DIR__) . "/logs/";
        if (!is_dir($directory)) {
            mkdir($directory);
        }
        $file = date('Y-m-d') . ".log";
        $path = $directory . $file;
        $data = date('H:i:s') . " " . $data;
        $handle = fopen($path, "a");

        if (flock($handle, LOCK_EX)) {
            fwrite($handle, $data . PHP_EOL);
            flock($handle, LOCK_UN);
        }
        fclose($handle);
    }
}
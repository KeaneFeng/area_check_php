<?php

function load_file($file_path)
{
    if (!file_exists($file_path)) {
        throw new Exception('File Not Found');
    }
    return include($file_path);
}

function config($key, $default = null, $reload = false)
{

    static $configs = [];
    if ($reload) {
        $configs = [];
    }

    if (!$key) {
        throw new Exception('Config Key Error');
    }
    $key_arr = explode('.', $key);

    $file = array_shift($key_arr);

    if (!isset($configs[$file])) {
        try {
            $configs[$file] = load_file(sprintf("%s/%s.php", __DIR__.DIRECTORY_SEPARATOR.'config', $file));
        } catch (Exception $e) {
            throw new Exception('Load File Error');
        }
    }

    $res = $configs[$file];
    if ($key_arr) {
        foreach ($key_arr as $item) {
            if (isset($res[$item])) {
                $res = $res[$item];
            } else {
                $res = null;
                break;
            }
        }
    }

    return !$res && !is_null($default) ? $default : $res;
}
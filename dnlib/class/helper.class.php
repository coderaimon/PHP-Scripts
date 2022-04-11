<?php

class Helper
{
    public static $is_page_available = false;
    public function route($path_url, $function)
    {
        $server_path = $_SERVER['PATH_INFO'] ?? NULL;
        if (!$server_path && $path_url == '/') {
            self::$is_page_available = true;
            $function(array());
        }

        $is_valid = true;
        $server_url_data = rtrim($server_path, '/');
        $server_url_data = ltrim($server_path, '/');

        $server_url_data = explode("/", $server_url_data);
        $path_url_data = explode("/", $path_url);
        $data = array();

        foreach ($path_url_data as $index => $param) {
            if (!isset($server_url_data[$index])) return;
            if ($server_url_data[$index] === $param) {
            } elseif (str_contains($param, '$')) {
                $data[ltrim($param, '$')] = $server_url_data[$index];
            } else {
                $is_valid = false;
            }
        }

        if ($is_valid) {
            self::$is_page_available = true;
            $function($data);
        }
    }

    public function moveFile($file, $dir, $extention = array())
    {
        $result = '';
        foreach ($extention as $ext) {
            $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (strtolower($ext) === $file_ext) {
                $file_name = time() . basename($file['name']);
                if (move_uploaded_file($file['tmp_name'], rtrim($dir, '/') . '/' . $file_name)) {
                    $result .= $file_name;
                }
            }
        }
        return $result;
    }

    public function redirect($path=''){
        header("location:".rtrim(SITE_URL,'/').'/'.$path);
    }

}

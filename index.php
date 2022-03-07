<?php
$s1 = microtime(true) * 10000;
session_start();
set_time_limit (600);
header('Access-Control-Allow-Origin: *');
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ini_set('default_socket_timeout', 10);
//date_default_timezone_set("GMT+0");
date_default_timezone_set('Asia/Ho_Chi_Minh');
function isMobileDevice() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
if(isMobileDevice()) $_SESSION['mobile']= 1;
else $_SESSION['mobile']= 0;

function loadFolderLibs($name) {
    $filename = PATH_LIBRARY . "{$name}.php";
    if(file_exists($filename)){
        require_once $filename;
    }
}
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
    default:
        spl_autoload_register('loadFolderLibs');
        require 'define.php';
        Session::init();
        require 'route.php';
        break;
}
$s2 = microtime(true) * 10000;
//echo ($s2-$s1);
?>
<?php
namespace php_mvc;
use libs\Url;
session_start();

define('ROOT',$_SERVER['DOCUMENT_ROOT'].'/');

spl_autoload_register(function($className) {
    $namespace = str_replace("\\", "/", __NAMESPACE__);
    $className = str_replace("\\", "/", $className);
    $class = ROOT . $namespace.'/'.$className.'.php';
    //print_r($class.'<br>');
    include_once($class);
});

function baseurl(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'] ;
}

new Url();

?>
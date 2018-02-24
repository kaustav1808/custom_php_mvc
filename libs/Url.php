<?php
namespace libs;
use controller\Err;
class Url
{
    function __construct()
    {
        //$url=rtrim($_GET,'/');
        if(empty($_GET)){
            include_once "controller/Index.php";
            $con=new \controller\Index();
            $con->show();
            return true;
        }else {
            $url = $_GET['url'];
            $url = explode('/', $url);//url extration

            $controller = $url[0];

            if (count($url) > 1) {
                $method = $url[1];
            }

            if (count($url) > 2) {
                $argument = Array();
                for ($i = 2; $i < count($url); $i++) {
                    array_push($argument, $url[$i]);
                }
            }


//check if the controller is exists

            $file = "controller/" . $controller . ".php";
            if (file_exists($file)) {
                include_once $file;
                $class="\\controller\\".$controller;
                $controller = new $class();
            } else {
                require_once "controller/Err.php";
                new Err();
                return false;
            }

//check if the method is exists
            if (!empty($method)){
                if (empty($argument)) {
                    if(method_exists($controller,$method)){
                        $controller->{$method}(null);
                    }else{
                      require_once "controller/Err.php";
                      new Err();
                      return false;
                    }
                } else {
                    if(method_exists($controller,$method)){
                        $controller->{$method}($argument);
                    }else{
                        require_once "controller/Err.php";
                        new Err();
                        return false;
                    }
                }
            }
            else{
             if($url[0]==="Index"){
                 $controller->show();
             }
//             else{
//                 require_once "controller/Err.php";
//                 new Err();
//                 return false;
//             }
            }
        }
    }
}


?>
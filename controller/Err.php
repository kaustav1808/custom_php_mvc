<?php
namespace controller;

use  libs\Controller;

class Err extends Controller{
    function __construct()
    {
        parent::__construct();
        $this->view->msg="there is a error";
        $this->view->render("error/index");
    }
}
?>
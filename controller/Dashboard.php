<?php
namespace controller;

use  libs\Controller;
use  libs\Session;

class Dashboard extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->view->render("dashboard");
    }

    public function logout(){
      Session::sessionDestroy();
      $str="Location:".\php_mvc\baseurl()."/php_mvc/Index/show";
      header($str);
    }

    public function myProfile(){
        $this->model=$this->loader("Dashboard");
        $status=$this->model->getUserProfile();
        if($status==="error"){
            $this->view->msg="oops! there is some internal error";
            $this->view->render("userlisting");
        }
        else{
            $this->view->row=$status;
            $this->view->render("myprofile");
        }
    }

    public function loader($class){
        $instance="model\\".$class;
        return new $instance;
    }
}

?>
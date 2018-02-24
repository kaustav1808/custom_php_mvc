<?php
namespace controller;

use  libs\Controller;

class Index extends Controller{

    public function __construct()
   {
       parent::__construct();
   }

   public function login(){

       $this->model=$this->loader("Login");
       $flag=$this->model->loginstatus();

       if($flag==="error"){
           $this->view->msg="There is some error";
           $this->view->render("error/index");
       }
       elseif($flag){
           $str="Location:".\php_mvc\baseurl()."/php_mvc/Dashboard";
         header($str);
       }
       else{
           $this->view->msg="Sorry username or password is incorrect";
           $this->view->render("index");
       }

   }

   public function register(){
       $this->model=$this->loader("Registration");
       $flag=$this->model->registrationStatus();

       if(gettype($flag)==="string"){
           switch ($flag){
               case "error":
                   $this->view->msg="There is some error";
                   $this->view->render("error/index");
                   break;
               case "userexists":
                   $this->view->msg="Sorry this email is already exists";
                   $this->view->render("index");
                   break;
               case "ext":
                   $this->view->msg="Please provide a valid file";
                   $this->view->render("index");
                   break;
               case "size":
                   $this->view->msg="your uploaded file exceeded the limit";
                   $this->view->render("index");
           }
       }
       else{
           switch ($flag){
               case true:
                   $this->view->msg2="you are successfully register";
                   $this->view->render("index");
                   break;
               case false:
                   $this->view->msg="Sorry we can't register you this moment";
                   $this->view->render("index");
           }
       }
   }

   public function showRegistration(){
       $this->view->render("registration");
   }

   public function show($msg=''){
       $this->view->render("index");
   }

   public function loader($class){
       $instance="model\\".$class;
       return new $instance;
   }

}

?>
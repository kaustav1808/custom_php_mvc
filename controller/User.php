<?php
namespace controller;

use  libs\Controller;

class User extends Controller{
  function __construct()
  {
   parent::__construct();
  }

  function userListing($page){
      $this->model=$this->loader("User");
      $userno=$this->model->userCount();

      if($userno==="error"){
          $this->view->msg="oops!There is some Connection problem";
          $this->view->render("userlisting");
      }
      $this->view->userno=$userno[0]["count"];
      $arr=$this->model->userList($page);
      krsort($arr);
      if(count($page)>1){
         $this->view->key=$page[1];
         $this->view->keyval=$page[2];
      }
      $this->view->userlist=$arr;
      $this->view->render("userlisting");
  }

  function addUserForm(){
   $this->view->render("adduser");
  }

  public function addUser(){
      $this->model=$this->loader("User");
      $status=$this->model->adduser();
      if(gettype($status)==="string"){
          switch($status){
              case "error":
                  $this->view->msg="There is some error.";
                  $this->view->render("error/index");
                  break;
              case "userexists":
                  $this->view->msg="Sorry! the user is already exists.";
                  $this->view->render("adduser");
                  break;
              case "ext":
                  $this->view->msg="please provide proper picture.";
                  $this->view->render("adduser");
                  break;
              case "size":
                  $this->view->msg="your picture size crosses the limit";
                  $this->view->render("adduser");
                  break;
          }
      }
      else{
          switch ($status){
              case true:
                  $location="Location:".\php_mvc\baseurl()."/php_mvc/User/userListing/0";
                  header($location);
                  break;
              case false:
                  $this->view->msg="<p>can not add the person</p>
                                    <br>
                                    <p> please try after some time</p>";
                  $this->view->render("adduser");
          }
      }
  }

  public function editUserForm($id){
      $this->model=$this->loader("User");
      $this->view->id=$id[0];
      $status=$this->model->getUserDetail($id);
      if($status==="error"){
          $this->view->msg="oop's ther is some internal error";
      }
      else{
          $this->view->row=$status;
      }
      $this->view->render("edituser");
}

  public function editUser($id){
      $this->model=$this->loader("User");
      $status=$this->model->editUser($id);
      if(gettype($status)==="string"){
          switch($status){
              case "error":
                  $this->view->msg="There is some error.";
                  $this->view->render("error/index");
                  break;
              case "ext":
                  $this->view->msg="please provide proper picture.";
                  $this->view->render("edituser");
                  break;
              case "size":
                  $this->view->msg="your picture size crosses the limit";
                  $this->view->render("edituser");
          }
      }
      else{
          switch ($status){
              case true:
                  $location="Location:".\php_mvc\baseurl()."/php_mvc/User/userListing/0";
                  header($location);
                  break;
              case false:
                  $this->view->msg="<p>can not add the person</p>
                                    <br>
                                    <p> please try after some time</p>";
                  $this->view->render("edituser");
          }
      }
  }

  public function deleteUser($id){
      $this->model=$this->loader("user");
      $status=$this->model->deleteUser($id);
      if($status==="error"){
          $this->view->msg="oops! there is some internal error";
          $this->view->render("userlisting");
      }
      else{
          $location="Location:".\php_mvc\baseurl()."/php_mvc/User/userListing/0";
          header($location);
      }

  }

  public function userSearch(){
      $this->model=$this->loader("User");
      $status=$this->model->userSearch();

      if($status==="error"){
          $this->view->msg="oops! there is some internal error";
          $this->view->render("userlisting");
      }
      else if (!$status){
          $location="Location:".\php_mvc\baseurl()."/php_mvc/User/userListing/0";
          header($location);
      }
      else{
          $this->view->userno=count($status);
          krsort($status);
          $this->view->userlist=$status;
          $this->view->render("userlisting");
      }
  }

  public function loader($class){
        $instance="model\\".$class;
        return new $instance;
    }

}
?>
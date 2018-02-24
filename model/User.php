<?php
namespace model;

use libs\Model;
use libs\Session;
use libs\FileUpload;
use libs\ImageUpload;


class User extends Model{

    function __construct()
    {
        parent::__construct();
    }

    function userCount(){

        //connect to the database
        $this->connection();
        if($this->iserror===true){
            return "error";
        }

        //run the sql command
        $sql = "SELECT count(*) as count FROM user WHERE addby=".Session::getsessionval("id");
        $this->runquery($sql);
        if($this->iserror===true){
            return "error";
        }

        //close database
        $this->disconnectdatabase();

        //return result
        return $this->getresult();
    }

    function userList($page){
        $start=(int)$page[0];
        if(count($page)>1){
            $key=$page[1];
            $keyval=" ".$page[2];
        }
        else{
            $key="id";
            $keyval=" ASC";
        }
        //connect to the database
        $this->connection();
        if($this->iserror===true){
            return "error";
        }

        //run the sql command
        $sql = "SELECT id,username,name,image from user WHERE addby=".Session::getsessionval("id")." ORDER BY ".$key.$keyval." LIMIT  ".$start.", 3;";
        $this->runquery($sql);
        if($this->iserror===true){
            return "error";
        }

        //close database
        $this->disconnectdatabase();

        //return result
        return $this->getresult();
    }

    function addUser(){

        //connect to the database
        $this->connection();
        if($this->iserror===true){
            return "error";
        }

        //check if the user is already exists
        $sql = "SELECT count(*)as count FROM user WHERE username='".$_POST["email"]."';";
        $this->runquery($sql);
        if($this->iserror===true){
            return "error";
        }
        else{
            $row=$this->getresult();
            if($row[0]["count"]>0){
                return "userexists";
            }
        }

        //image processing
        $image=new ImageUpload;
        $image->setImage($_FILES);
        $image->imageUpload();

        if($image->getErrorStatus()){
            return $image->getErrorStatus();
        }

        //run the sql command
        $arr=array(
            "addby"=>Session::getsessionval("id"),
            "username"=>$_POST["email"],
            "password"=>md5($_POST["password"]),
            "name"=>$_POST["name"],
            "image"=>$image->getImageName()
        );
        $sql = "INSERT INTO user(addby,username,password,name,image)VALUES(:addby,:username,:password,:name,:image)";
        $this->exePrepare($arr,$sql);
        if($this->iserror===true){
            return "error";
        }

        //close database
        $this->disconnectdatabase();

        //return result
        return true;
    }

    function editUser($id){

        //connect to the database
        $this->connection();
        if($this->iserror===true){
            return "error";
        }

        //image processing
        if(isset($_FILES["photo"]) && ($_FILES["photo"]["error"] == 0)){
            $image=new ImageUpload;
            $image->setImage($_FILES);
            $image->imageUpload();

            if($image->getErrorStatus()){
                return $image->getErrorStatus();
            }
            $arr=array(
                "username"=>$_POST["email"],
                "name"=>$_POST["name"],
                "image"=>$image->getImageName(),
                "id"=>$id[0]
            );
            $sql="UPDATE user SET username=:username,name=:name,image=:image WHERE id=:id";
        }
        else{
            $arr=array(
                "username"=>$_POST["email"],
                "name"=>$_POST["name"],
                "id"=>$id[0]
            );
            $sql="UPDATE user SET username=:username,name=:name WHERE id=:id";
        }

        //run the sql command
        $this->exePrepare($arr,$sql);
        if($this->iserror===true){
            return "error";
        }

        //close database
        $this->disconnectdatabase();

        //get user count
        return $this->getExecuteResult();
    }

    function getUserDetail($id){

        //connect to the database
        $this->connection();
        if($this->iserror===true){
            return "error";
        }

        //run the sql command
        $arr=array(
            "id"=>$id[0]
        );
        $sql = "SELECT name,username,image FROM user WHERE id=:id";
        $this->exePrepare($arr,$sql);
        if($this->iserror===true){
            return "error";
        }

        //close database
        $this->disconnectdatabase();

        //get user count

        return $this->getresult();

    }

    function deleteUser($id){
        //connect to the database
        $this->connection();
        if($this->iserror===true){
            return "error";
        }

        //run the sql command
        $sql="DELETE FROM user WHERE id=".$id[0];
        $this->runquery($sql);
        if($this->iserror===true){
            return "error";
        }

        //close database
        $this->disconnectdatabase();

        //get user count
        return $this->getresult();
    }

    function userSearch(){

        if(!$_POST["search"]){
            return false;
        }

        //connect to the database
        $this->connection();
        if($this->iserror===true){
            return "error";
        }

        //run the sql command
        $arr=array(
            "name"=>"%".$_POST["search"]."%",
            "username"=>"%".$_POST["search"]."%",
            "addby"=>Session::getsessionval("id")
        );
        $sql="SELECT name,username,image,id FROM user WHERE addby=:addby AND (name LIKE  :name OR username LIKE :username) ORDER BY id ASC";
        $this->exePrepare($arr,$sql);
        if($this->iserror===true){
            return "error";
        }

        //close database
        $this->disconnectdatabase();

        //get user count
        return $this->getresult();
    }
}?>
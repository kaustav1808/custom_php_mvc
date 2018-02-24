<?php
namespace model;

use libs\Model;
use libs\Validation;
use libs\FileUploade;
use libs\ImageUpload;

class Registration  extends Model{
    private $registrationflag=true;

    function __construct()
    {
        parent::__construct();
    }

    private function execRegistration(){
        $user=$_POST["email"];
        $password=$_POST["password"];
        $name=$_POST["name"];

        //connect to the database
        $this->connection();
        if($this->iserror===true){
            return "error";
        }

        //user data for sanitize and validate
        $flag=new Validation;
        $flag=$flag->passwordvalidation($password);

        if(!$flag){
            $this->registrationflag=false;
            return false;
        }

        //check if the user is already exists
        $sql = "SELECT count(*)as count FROM user WHERE username='".$user."';";
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

        //image process
        $image=new ImageUpload;
        $image->setImage($_FILES);
        $image->imageUpload();

        if($image->getErrorStatus()){
            return $image->getErrorStatus();
        }

        //insert user data in database
        $sql = "INSERT INTO user(addby,username,password,name,image)VALUES(0,'".$user."','".md5($password)."','".$name."','".$image->getImageName()."')";
        $this->runquery($sql);
        if($this->iserror===true){
            return "error";
        }
        return true;

        //close database
        $this->disconnectdatabase();
    }

    public function registrationStatus(){
        $status=$this->execRegistration();

        if(gettype($status)==="string"){
            switch($status){
                case "error":
                    return "error";
                    break;
                case "userexists":
                    return "userexists";
                    break;
                case "ext":
                    return "ext";
                    break;
                case "size":
                    return "size";
            }
        }
        else{
            switch ($status){
                case true:
                    return true;
                    break;
                case false:
                    return false;
            }
        }
    }
}

?>
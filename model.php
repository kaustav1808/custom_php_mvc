<?php
//namespace php_mvc\model;

class Login extends \php_mvc\libs\Model{
    private $loginflag=true;

    function __construct()
    {
        parent::__construct();
    }

    private function execlogin(){
        $user=$_POST["email"];
        $password=$_POST["password"];

        //connect to the database
        $this->connection();
        if($this->iserror===true){
            return "error";
        }

        //check the user data for sanitize and validate
        $flag=new \php_mvc\libs\Validation;
        $flag=$flag->passwordvalidation($password);

        if(!$flag){
            $this->loginflag=false;
            return false;
        }

        //run the sql command
        $sql = "SELECT id,image,name FROM user WHERE username='" . $user . "' AND password='" . md5($password) . "' ;";
        $this->runquery($sql);
        if($this->iserror===true){
            return "error";
        }

        //get user count
        $row=$this->getresult();
        if(count($row)>=1){
            \php_mvc\libs\Session::sessionSet("id",$row[0]['id']);
            \php_mvc\libs\Session::sessionSet("image",$row[0]['image']);
            \php_mvc\libs\Session::sessionSet("name",$row[0]['name']);
            $this->loginflag=true;
        }
        else{
            $this->loginflag=false;
        }

        //close database
        $this->disconnectdatabase();
    }

    public function loginstatus(){
        $status=$this->execlogin();
        if($status!=="error"){
            if($this->loginflag===true){
                return 1;
            }
            else{
                return 0;
            }
        }
        else{
            return "error";
        }
    }
}

class Registration  extends \php_mvc\libs\Model{
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
        $flag=new \php_mvc\libs\Validation;
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
        $image=new \php_mvc\libs\ImageUpload;
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

class User extends \php_mvc\libs\Model{

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
        $sql = "SELECT count(*) as count FROM user WHERE addby=".\php_mvc\libs\Session::getsessionval("id");
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
        $sql = "SELECT id,username,name,image from user WHERE addby=".\php_mvc\libs\Session::getsessionval("id")." ORDER BY ".$key.$keyval." LIMIT  ".$start.", 3;";
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
        $image=new \php_mvc\libs\ImageUpload;
        $image->setImage($_FILES);
        $image->imageUpload();

        if($image->getErrorStatus()){
            return $image->getErrorStatus();
        }

        //run the sql command
        $arr=array(
            "addby"=>\php_mvc\libs\Session::getsessionval("id"),
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
            $image=new \php_mvc\libs\ImageUpload;
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
            "addby"=>\php_mvc\libs\Session::getsessionval("id")
        );
        $sql="SELECT name,username,image FROM user WHERE addby=:addby AND (name LIKE  :name OR username LIKE :username) ORDER BY id ASC";
        $this->exePrepare($arr,$sql);
        if($this->iserror===true){
            return "error";
        }

        //close database
        $this->disconnectdatabase();

        //get user count
        return $this->getresult();
    }
}

class Dashboard  extends \php_mvc\libs\Model{

    function __construct()
    {
        parent::__construct();
    }

    public function getUserprofile(){
        //connect to the database
        $this->connection();
        if($this->iserror===true){
            return "error";
        }

        //run the sql command
        $arr=array(
            "id"=>\php_mvc\libs\Session::getsessionval("id")
        );
        $sql="SELECT name,username,image FROM user WHERE id=:id ";
        $this->exePrepare($arr,$sql);
        if($this->iserror===true){
            return "error";
        }

        //close database
        $this->disconnectdatabase();

        //get user count
        return $this->getresult();
    }

}
?>
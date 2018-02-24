<?php
namespace model;

use libs\Model;
use libs\Validation;
use libs\Session;
class Login extends Model{
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
        $flag=new Validation;
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
            Session::sessionSet("id",$row[0]['id']);
            Session::sessionSet("image",$row[0]['image']);
            Session::sessionSet("name",$row[0]['name']);
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
?>
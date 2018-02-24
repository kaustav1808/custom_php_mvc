<?php
namespace model;

use libs\Model;
use libs\Session;
class Dashboard  extends Model{

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
            "id"=>Session::getsessionval("id")
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
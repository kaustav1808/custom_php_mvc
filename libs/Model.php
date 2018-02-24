<?php
namespace libs;

class Model
{
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $conn;
    public $iserror = false;
    private $result;
    private $isprepare=0;
    private $isexecute=false;
    private $prepare;

    function __construct()
    {
        $this->host = "localhost";
        $this->dbname = "kaustav";
        $this->username = "root";
        $this->password = 12345;
    }

    function connection()
    {
        try {
            $this->conn = new \PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            $this->iserror = true;
        }
    }

    function runquery($string)
    {
        $this->result = $this->conn->query($string);
        if (!$this->result) {
            $this->iserror = true;
        }
    }

    function exePrepare($arr,$sql){
        $this->prepare=$this->conn->prepare($sql);
        foreach ($arr as $key=>$value){
            $bindkey=':'.$key;
            $flag=$this->prepare->bindValue($bindkey,$value);
            if(!$flag){
                $this->iserror=true;
                return false;
            }
        }
        $flag=$this->prepare->execute();
        if(!$flag){
            $this->iserror=true;
            return false;
        }
        $this->isexecute=true;
        $this->isprepare=1;
    }

    function disconnectdatabase()
    {
        unset($conn);
    }

    function getresult()
    {
        if (($this->result)&&(!($this->isprepare))) {
            $row = array();
            try{
                while ($r = $this->result->fetch(\PDO::FETCH_ASSOC)) {
                    array_push($row, $r);
                }
            }catch(\PDOException $e){
                return true;
            }
            return $row;
        }
        else if ($this->isprepare){
            $this->result=$this->prepare->fetchAll(\PDO::FETCH_ASSOC);
            return $this->result;
        }
    }

    function getExecuteResult(){
        if($this->isexecute){
            return true;
        }
        else{
            return false;
        }
    }

}

?>
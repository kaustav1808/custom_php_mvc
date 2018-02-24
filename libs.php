<?php

//namespace php_mvc\libs;

class Controller
{
    public function __construct()
    {
        $this->view = new View();
    }
}

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

class Url
{
    function __construct()
    {
        if (empty($_GET)) {
            include_once "controller/Index.php";
            $con = new \Index();
            $con->show();
            return true;
        } else {
            $url = $_GET['url'];
            rtrim($url, '//');
            $url = explode('/', $url);//url extration

            $controller = $url[0];

            if (count($url) > 1) {
                $method = $url[1];
            }

            if (count($url) > 2) {
                $argument = Array();
                for ($i = 2; $i < count($url); $i++) {
                    array_push($argument, $url[$i]);
                }
            }


//check if the controller is exists

            $file = "controller/" . $controller . ".php";
            if (file_exists($file)) {
                include_once $file;
                $controller = new $controller();
            } else {
                require_once "controller/Err.php";
                new \Err();
                return false;
            }

//check if the method is exists
            if (!empty($method)) {
                if (empty($argument)) {
                    if (method_exists($controller, $method)) {
                        $controller->{$method}(null);
                    } else {
                        require_once "controller/Err.php";
                        new \Err();
                        return false;
                    }
                } else {
                    if (method_exists($controller, $method)) {
                        $controller->{$method}($argument);
                    } else {
                        require_once "controller/Err.php";
                        new \Err();
                        return false;
                    }
                }
            } else {
                if ($url[0] === "Index") {
                    $controller->show(null);
//                } else {
//                    require_once "controller/Err.php";
//                    new \Err();
//                    return false;
                }
            }
        }
    }
}

class View
{
    public function render($name)
    {
        include_once 'view/' . $name . '.php';
    }
}

class Validation
{
    public static function passwordvalidation($string)
    {
        $reg = array("options" => array("regexp" => "/^[a-z A-Z 0-9]/"));
        $var = filter_var($string, FILTER_VALIDATE_REGEXP, $reg);

        if (!$var) {
            return false;
        } else {
            return true;
        }
    }
}

class Session
{
    public static function sessionSet($key, $id)
    {
        $_SESSION[$key] = $id;
    }

    public static function sessionDestroy()
    {
        unset($_SESSION);
        session_destroy();
    }
    public static function getsessionval($key){
        return $_SESSION[$key];
    }
}

class FileUpload
{
    private $file, $ext;

    protected function setFileName($file)
    {
        $this->file = $file;
    }

    protected function moveTempFile($path)
    {
        $bool = move_uploaded_file($this->file["photo"]["tmp_name"], $path);
        if ($bool) {
            return true;
        } else {
            return false;
        }
    }

    protected function fileSizeValidate($size)
    {
        return ($size > $this->file["photo"]["size"]);
    }

    protected function fileExtCheck($arr)
    {
        $this->ext = explode("/", $this->file["photo"]["type"]);

        foreach ($arr as $ext) {
            if ($ext === $this->ext[1]) {
                return true;
            }
        }
        return false;
    }

    protected function fileRename($type)
    {
        $rnd_name = $type . '_' . 'php_mvc' . '_' . uniqid(mt_rand(10, 100)) . '_' . time() . "." . $this->ext;
        return $rnd_name;
    }

    public function getFileAttr($string)
    {
        return $this->file["photo"][$string];
    }

    public function getFileExt()
    {
        return $this->ext[1];
    }
}

class ImageUpload extends FileUpload
{
    private $flag, $newname;

    public function setImage($image)
    {
        $this->setFileName($image);
    }

    private function imageResize()
    {
        $ext = $this->getFileExt();

        $ext = strtolower($ext);
        $uploaded_file = $this->getFileAttr("tmp_name");
        if ($ext == "jpg" || $ext == "jpeg")
            $source = imagecreatefromjpeg($uploaded_file);
        else if ($ext == "png")
            $source = imagecreatefrompng($uploaded_file);
        else
            $source = imagecreatefromgif($uploaded_file);

        // getimagesize() function simply get the size of an image
        $arr = getimagesize($uploaded_file);
        $width = $arr[0];
        $height = $arr[1];

        $ratio = $height / $width;

        // new width 50(this is in pixel format)
        $nw = 200;
        $nh = ceil($ratio * $nw);
        $dst = imagecreatetruecolor($nw, $nh);


        imagecopyresampled($dst, $source, 0, 0, 0, 0, $nw, $nh, $width, $height);

        // rename our upload image file name, this to avoid conflict in previous upload images
        // to easily get our uploaded images name we added image size to the suffix
        $rnd_name = 'photos_' .'php_mvc_'.uniqid(mt_rand(10, 100)) . '_' . time() . "." . $ext;
        // move it to uploads dir with full quality
        if (imagejpeg($dst,'asset/profileimage/thumbnail/' . $rnd_name, 100)) {
            $this->newname = $rnd_name;
            return true;
        } else {
            return false;
        }
    }

    public function imageUpload()
    {
        $arr = array("jpg", "jpeg", "gif", "png");
        if (!$this->fileExtCheck($arr)) {
            $this->flag = "ext";
            return false;
        }
        if (!$this->fileSizeValidate(5242880)) {
            $this->flag = "size";
            return false;
        }
        if (!$this->imageResize()) {
            $this->flag = "error";
            return false;
        }
        if (isset($this->flag)) {
            return false;
        }
        if (!$this->moveTempFile( "asset/profileimage/" . $this->newname)) {
            $this->flag = "error";
        }
    }

    public function getErrorStatus()
    {
        if (isset($this->flag)) {
            return $this->flag;
        } else {
            return false;
        }
    }

    public function getImageName()
    {
        return $this->newname;
    }
}

?>
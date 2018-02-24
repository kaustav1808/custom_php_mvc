<?php
namespace libs;
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


?>
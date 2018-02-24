<?php
namespace libs;
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
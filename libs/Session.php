<?php
namespace libs;
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
?>
<?php
    namespace libs;
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
?>
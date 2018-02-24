<?php

namespace libs;
class View
{
    public function render($name)
    {
        include_once 'view/' . $name . '.php';
    }
}

?>
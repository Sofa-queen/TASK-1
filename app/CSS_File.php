<?php
namespace php_docker\app;

class CSS_File extends File
{
    public function __construct($type, $name)
    {
        $this->type = $type;
        $this->name = "web/css/$name";
    }
}
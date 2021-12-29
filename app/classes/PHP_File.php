<?php
namespace App\Classes;

class PHP_File extends File
{
    public function __construct($type, $name)
    {
        $this->type = $type;
        $this->name = $name;
    }
}
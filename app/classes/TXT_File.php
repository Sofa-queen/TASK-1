<?php
namespace App\Classes;

class TXT_File extends File
{
    public function __construct($type, $name)
    {
        $this->type = $type;
        $this->name = "texts/$name";
    }
}
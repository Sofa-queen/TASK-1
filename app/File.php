<?php
namespace php_docker\app;
use php_docker\EmptyException;

abstract class File implements File_Contents
{
    protected $type;
    protected $name;

    abstract public function __construct($type, $name);

    public function readFile()
    {
        if(file_exists($this->name) == false)
            throw new \Exception($this->name);

        if(filesize($this->name) == 0)
            throw new EmptyException($this->name);

        echo "\n+==============================+\n";
        echo "+ " . mb_strtoupper($this->type) . " file $this->name +\n";
        echo "+==============================+\n\n";

        $lines = file($this->name);
        foreach ($lines as $line_num => $line) {
            echo $line_num . " " . htmlspecialchars($line);
        }
        echo "\n";
    }
}
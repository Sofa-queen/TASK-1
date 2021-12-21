<?php
interface File_Contents
{
    public function readFile();
}

abstract class File implements File_Contents
{
    protected $type;
    protected $name;

    abstract public function __construct($type, $name);

    public function readFile()
    {
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

class CSS_File extends File
{
    public function __construct($type, $name)
    {
        $this->type = $type;
        $this->name = "web/css/$name";
    }
}

class TXT_File extends File
{
    public function __construct($type, $name)
    {
        $this->type = $type;
        $this->name = "texts/$name";
    }
}

class PHP_File extends File
{
    public function __construct($type, $name)
    {
        $this->type = $type;
        $this->name = $name;
    }
}

//var_dump($argv);
class ReadFileFactory
{
    public static function createFileContent($type, $name)
    {
        switch ($type) {
            case 'css':
                return new CSS_File($type, $name);
            case 'txt':
                return new TXT_File($type, $name);
            case 'php':
                return new PHP_File($type, $name);
        }
    }
}

$obj = ReadFileFactory::createFileContent($argv[1], $argv[2]);
$obj->readFile();
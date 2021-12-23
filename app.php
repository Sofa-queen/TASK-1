<?php

class EmptyException extends Exception { }
class NameException extends Exception { }
class ObjException extends Exception { }
class TypeException extends Exception { }

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
        if(file_exists($this->name) == false)
            throw new Exception($this->name);

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

class ReadFileFactory
{
    public static function createFileContent($type, $name)
    {
        try {
            if($type !== 'css' && $type !== 'txt' && $type !== 'php')
                throw new TypeException($type);

            if($name == NULL)
                throw new NameException('ERROR: ');

            switch ($type) {
                case 'css':
                    return new CSS_File($type, $name);
                case 'txt':
                    return new TXT_File($type, $name);
                case 'php':
                    return new PHP_File($type, $name);
            }
        } catch (NameException $e) {
            echo $e->getMessage() . "You didn't specify a file name!!!\n";
        } catch (TypeException $e) {
            echo "ERROR: You cannot output a file of the type: " . $e->getMessage() . "\n";
        }
    }
}

$obj = ReadFileFactory::createFileContent($argv[1], $argv[2]);
try {
    if($obj == NULL) throw new ObjException('ERROR');
    $obj->readFile();
} catch (ObjException $e) {
    echo $e->getMessage() . "!!!\n";
}catch (EmptyException $e) {
    echo "The file " . $e->getMessage() . " is empty!!!\n";
} catch (Exception $e) {
    echo "The file " . $e->getMessage() . " does not exist!!!\n";
}
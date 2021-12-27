<?php
namespace php_docker\app;
use php_docker\TypeException;
use php_docker\NameException;

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

<?php
namespace App\Classes;
use App\Classes\MyException\TypeException;
use App\Classes\MyException\NameException;
use Symfony\Component\Console\Output\ConsoleOutput;

class ReadFileFactory
{
    public static function createFileContent($type, $name)
    {
        $output = new ConsoleOutput();

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
            $output->writeln("<comment>" . $e->getMessage() . "You didn't specify a file name!!!</comment>");
            //echo $e->getMessage() . "You didn't specify a file name!!!\n";
        } catch (TypeException $e) {
            $output->writeln("<comment>ERROR: You cannot output a file of the type: " . $e->getMessage() . "</comment>");
            //echo "ERROR: You cannot output a file of the type: " . $e->getMessage() . "\n";
        }
    }
}

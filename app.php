<?php
require 'vendor/autoload.php';
use App\Classes\MyException\EmptyException;
use App\Classes\MyException\ObjException;
use App\Classes\ReadFileFactory;
use Symfony\Component\Console\Output\ConsoleOutput;

$output = new ConsoleOutput();

$obj = ReadFileFactory::createFileContent($argv[1], $argv[2]);
try {
    if($obj == NULL) throw new ObjException('ERROR');
    $obj->readFile();
} catch (ObjException $e) {
    echo $e->getMessage() . "!!!\n";
}catch (EmptyException $e) {
    $output->writeln("<error>The file " . $e->getMessage() . " is empty!!!</error>");
    //echo "The file " . $e->getMessage() . " is empty!!!\n";
} catch (\Exception $e) {
    $output->writeln("<question>The file " . $e->getMessage() . " does not exist!!!</question>");
    //echo "The file " . $e->getMessage() . " does not exist!!!\n";
}
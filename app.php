<?php
namespace php_docker;
use php_docker\EmptyException;
use php_docker\app\ReadFileFactory;

$obj = ReadFileFactory::createFileContent($argv[1], $argv[2]);
try {
    if($obj == NULL) throw new ObjException('ERROR');
    $obj->readFile();
} catch (ObjException $e) {
    echo $e->getMessage() . "!!!\n";
}catch (EmptyException $e) {
    echo "The file " . $e->getMessage() . " is empty!!!\n";
} catch (\Exception $e) {
    echo "The file " . $e->getMessage() . " does not exist!!!\n";
}
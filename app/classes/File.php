<?php
namespace App\Classes;
use App\Classes\MyException\EmptyException;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Output\ConsoleOutput;

abstract class File implements File_Contents
{
    protected $type;
    protected $name;

    abstract public function __construct($type, $name);

    public function readFile()
    {
        if($this->type == 'css'){
            $color = 'black';
            $text = 'red';
        }
        if($this->type == 'txt'){
            $color = 'black';
            $text = 'cyan';
        }
        if($this->type == 'php'){
            $color = 'black';
            $text = 'magenta';
        }
        $outputStyle = new OutputFormatterStyle($text, $color, ['bold', 'blink']);
        $output = new ConsoleOutput();
        $output->getFormatter()->setStyle('fire', $outputStyle);

        if(file_exists($this->name) == false)
            throw new \Exception($this->name);

        if(filesize($this->name) == 0)
            throw new EmptyException($this->name);

        echo "\n+==============================+\n";
        $output->writeln("<fire>+ " . mb_strtoupper($this->type) . " file " . $this->name . " +</>");
        //echo "+ " . mb_strtoupper($this->type) . " file $this->name +\n";
        echo "+==============================+\n\n";

        $lines = file($this->name);
        foreach ($lines as $line_num => $line) {
            echo $line_num . " " . htmlspecialchars($line);
        }
        echo "\n";
    }
}
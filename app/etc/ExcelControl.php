<?php

namespace App\Etc;

class ExcelControl
{
    private $path;

    private $header;

    private $body;

    public function __construct($path = null)
    {   
        $this->header = [];
        $this->body = [];

        if(!is_null($path))
            $this->load($path);
    }

    public function load($path)
    {
        $this->path = $path;
        $this->setFile();
        
    }

    private function setFile()
    {
        $file = fopen($this->path, 'r');
        $body = [];

        $this->header = fgetcsv($file);

        while(!feof($file))
        {
            foreach(fgetcsv($file) as $line)
                array_push($body, $line);
        }

        $this->body = array_chunk($body, count($this->header));

        fclose($file);

    }

    public function getHeader()
    {
        return $this->header;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function import($callback)
    {
        foreach($this->body as $row)
        {
            $callback($row, $this->header);
        }
    }
}
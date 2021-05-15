<?php declare(strict_types=1);

namespace Cleiton080\Csv;

/**
 * Get a csv file and import samewhere else
 */
class Import extends Csv
{
    /**
     * New instance
     * 
     * @param string|null $path 
     */
    public function __construct($path = null)
    {   
        parent::__construct();
        
        if(!is_null($path))
            $this->load($path);
    }

    /**
     * Load csv file
     * 
     * @param string $path
     * @return void
     */
    public function load(string $path): void
    {
        $this->path = $path;
        $this->setFile();
        
    }

    /**
     * read csv file at driver
     * 
     * @return void
     */
    private function setFile(): void
    {
        $file = fopen($this->path, 'r');
        $body = [];

        $this->header = fgetcsv($file, 0, $this->delimiter);

        while(!feof($file))
        {
            foreach(fgetcsv($file, 0, $this->delimiter) as $line)
                array_push($body, $line);
        }

        $this->body = array_chunk($body, count($this->header));

        fclose($file);

    }

    /**
     * Import csv file
     * 
     * @param function $callback
     * @return void
     */
    public function import($callback): void
    {
        foreach($this->body as $row)
        {
            $callback($row, $this->header);
        }
    }
}
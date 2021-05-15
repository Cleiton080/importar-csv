<?php declare(strict_types=1);

namespace Cleiton080\Csv;

/**
 * Get some data and export to csv
 */
class Export extends Csv
{
    /**
     * New instance
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Turn objects into csv string
     * 
     * @param stdObject|array
     * @return void
     */
    protected function export($data): void
    {
        if(!empty($data) && $this->hasHeader) {
            $header = join($this->delimiter, array_keys((array) $data[0]));

            array_push($this->header, $header);
        }

        
        foreach($data as $row) {
            $columns = join($this->delimiter, array_values((array) $row));
            
            array_push($this->body, $columns);
        }
    }

    /**
     * Export csv file to a specific path
     * 
     * @param stdClass|array $data
     * @param string $path
     * @return void
     */
    public function exportAt($data, $path): void
    {
        $this->export($data);

        $csvContent = array_merge($this->header, $this->body);

        try {
            $csv = fopen($path, 'w');
    
            foreach($csvContent as $line) {
                fwrite($csv, $line . PHP_EOL);
            }
    
            fclose($csv);
        } catch(\Exception $e) {
            die($e->getMessage());
        }
    }
}
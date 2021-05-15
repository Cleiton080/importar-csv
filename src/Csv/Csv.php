<?php declare(strict_types=1);

namespace Cleiton080\Csv;

class Csv
{
    /**
     * Csv path
     * @var string
     */
    protected $path;

    /**
     * Csv header
     * @var array
     */
    protected $header;

    /**
     * Csv body
     * @var array
     */
    protected $body;

    /**
     * Csv delimiter
     * @var string
     */
    protected $delimiter;

    /**
     * Whether the csv file has header or not
     * @var bool
     */
    protected $hasHeader;


    public function __construct()
    {   
        $this->header = [];
        $this->body = [];
        $this->delimiter = ',';
        $this->hasHeader = true;
    }

    /**
     * Set a new csv delimiter
     * 
     * @param string $delimiter
     * @return void
     */
    public function setDelimiter(string $delimiter): void
    {
        $this->delimiter = $delimiter;
    }

    /**
     * Access csv header
     * 
     * @return array
     */
    public function getHeader(): array
    {
        return $this->header;
    }

    /**
     * Access csv body
     * 
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }
}
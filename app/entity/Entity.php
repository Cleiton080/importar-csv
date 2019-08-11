<?php

namespace App\Entity;

use \PDO;

use \PDOException;

class Entity
{
    private $connection;

    protected $table;

    protected $primaryKey;

    protected $autoIncrement;

    protected $attributes;

    protected $fillable;

    public function __construct()
    {
        $this->connection = new PDO('mysql:host=localhost;dbname=excel', 'cleiton', 'futuro123');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function __set($name, $value)
    {
        if(in_array($name, $this->fillable))
            $this->attributes[$name] = "'{$value}'";
    }

    public function save()
    {
        try {
            
            $statement = $this->connection->prepare('insert into '. $this->table .' values ('.implode(', ' , $this->attributes).') ');
            var_dump($statement);
            return $statement->execute();

        } catch(PDOException $exception) {
            die($exception->getMessage());
        }
        
    }

    public function autoIncrement(bool $increment)
    {
        if($increment)
            $this->attributes[$this->primaryKey] = 'null';
            
    }
}
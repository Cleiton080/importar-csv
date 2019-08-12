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
        $this->connection = new PDO('mysql:host=localhost;dbname=csv', 'cleiton', 'futuro123');
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

    public function read(array $fields = ['*'])
    {
        try {

            $statement = $this->connection->prepare("SELECT ". implode(', ', $this->in_fillable($fields)) ." FROM {$this->table}");
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_OBJ);
            
            return $data;

        } catch(PDOException $exception) {
            die($exception->getMessage());
        }

    }

    public function where($field, $value)
    {
        $result = $this->read();

        return array_map(function($item) use ($field, $value) {
            return $item;
        }, $result);
    }

    protected function in_fillable($fields)
    {
        foreach($fields as $key => $field)
            if(!in_array($field, $this->fillable) && !strstr($field, $this->primaryKey))
                unset($fields[$key]);

        return $fields;
    }
}
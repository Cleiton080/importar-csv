<?php

namespace App\Entity;

require_once 'Entity.php';

class DominioEntity extends Entity
{
    public function __construct()
    {
        parent::__construct();

        $this->table = 'dominios';

        $this->primaryKey = 'id';

        $this->fillable = [
            'dominio', 'documento', 'nome', 'uf', 'cidade', 'data_cadastro'
        ];

        $this->autoIncrement(true);
    }
}
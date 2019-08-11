<?php


namespace App\Entity\UserEntity;

require_once 'Entity.php';

use App\Entity\Entity;

class UserEntity extends Entity
{
    public function __construct()
    {
        parent::__construct();

        $this->table = 'users';

        $this->primaryKey = 'id';

        $this->fillable = [
            'name', 'age'
        ];
    }

}
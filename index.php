<?php

require_once 'vendor/autoload.php';

use Cleiton080\Csv\Export;

$csv = new Export();

$csv->setDelimiter(';');

$csv->exportAt([
    [
        'id' => 1,
        'name' => 'cleiton',
        'age' => 21
    ]
], 'tmp/teste.csv');
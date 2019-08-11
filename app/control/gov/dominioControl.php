<?php

use App\Entity\DominioEntity;
use App\Etc\ExcelControl;

require_once '../../entity/DominioEntity.php';
require_once '../../etc/ExcelControl.php';

$dominio = new DominioEntity;

$csv = new ExcelControl;

$csv->delimiter = ';';

$csv->load('http://localhost/excel-control/app/storage/excel/Dominios_GovBR_basico.csv');

$csv->import(function($row) use ($dominio) {

    if(!strstr($row[3], 'RJ') && is_bool(array_search('', $row)))
        return false;

    $dominio->dominio = $row[0];
    $dominio->documento = $row[1];
    $dominio->nome = $row[2];
    $dominio->uf = $row[3];
    $dominio->cidade = $row[4];
    $dominio->data_cadastro = $row[6];

    $dominio->save();

});

echo 'Finalizado';
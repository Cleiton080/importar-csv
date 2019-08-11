<?php

require_once '../../entity/UserEntity.php';
require_once '../../etc/ExcelControl.php';

use App\Entity\UserEntity\UserEntity;
use App\Etc\ExcelControl;

$excel = $_FILES['excel'];

$user = new UserEntity;
$excelControl = new ExcelControl('http://localhost/excel-control/app/storage/excel/MyExcel.csv');

$excelControl->import(function($row) use ($user) {
    $user->setName($row[0]);
    $user->setAge($row[1]);
});

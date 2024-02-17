<?php

use App\Entities\TimeSheet;

$timesheetRepository = $entityManager
    ->getRepository(TimeSheet::class);

$res = $timesheetRepository->getTimesheetsByEmployerName($name);

if (!count($res)) {
    echo 'Таймшитов не найдено!' . "\n";
} else {
    $a = 123;
    $table = new Console_Table();
    $table->setHeaders(array_keys($res[0]));
    foreach($res as $row) {
        $table->addRow(array_values($row));
    }
    echo $table->getTable();
}
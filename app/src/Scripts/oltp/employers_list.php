<?php

use App\Entities\Employer;

$employerRepository = $entityManager
    ->getRepository(Employer::class);

$data = $entityManager->getConnection()
    ->executeQuery('SELECT id, name FROM employees')
    ->fetchAll();

$table = new Console_Table();
$table->setHeaders(array_keys($data[0]));
foreach ($data as $row) {
    $table->addRow(array_values($row));
}
echo $table->getTable();
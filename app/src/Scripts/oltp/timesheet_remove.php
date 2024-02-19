<?php
use App\Entities\TimeSheet;
use App\Services\Logger;


$table = new Console_Table();
$entityManager->beginTransaction();
try {
    $connection = $entityManager->getConnection();

    $sql = "SELECT t.id FROM timesheets t JOIN employees e on  e.id  = t.employer_id   WHERE e.name = :name";
    $statement = $connection->prepare($sql);
    $statement->bindParam('name', $name);
    $timesheet_ids = $statement->execute()->fetchAll();

    if (count($timesheet_ids) === 0) {
        echo 'Запись для удаление не найдена!' . "\n";
        throw new Exception('Запись для удаление не найдена!');
    }

    $sql = "DELETE t FROM timesheets t JOIN employees e on e.id  = t.employer_id WHERE e.name = :name";
    $statement = $connection->prepare($sql);
    $statement->bindParam('name', $name);
    $timesheet = $statement->execute();
    $entityManager->commit();
    
    $timesheet_ids = array_column($timesheet_ids, 'id');
    $timesheet_ids = implode(', ', $timesheet_ids);
    echo "Timesheet with id: $timesheet_ids removed" . "\n";
} catch (\Throwable $e) {
    $entityManager->rollback();
    echo 'Error! See more info in log files!' . $e->getMessage() . "\n";
    Logger::logError($e->getMessage());
}

<?php
use App\Entities\TimeSheet;
use App\Services\Logger;


$table = new Console_Table();
$entityManager->beginTransaction();
try {
    $connection = $entityManager->getConnection();

    $sql = "SELECT * FROM timesheets WHERE task_id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindParam('id', $id);
    $timesheet = $statement->execute()->fetchAll();

    if (count($timesheet) === 0) {
        echo 'Запись для удаление не найдена!' . "\n";
        throw new Exception('Запись для удаление не найдена!');
    }

    $sql = "DELETE FROM timesheets WHERE task_id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindParam('id', $id);
    $timesheet = $statement->execute();
    $entityManager->commit();
    
    echo "Timesheet id $id removed" . "\n";
} catch (\Throwable $e) {
    $entityManager->rollback();
    echo 'Error! See info in log files!' . "\n";
    Logger::logError($e->getMessage());
}

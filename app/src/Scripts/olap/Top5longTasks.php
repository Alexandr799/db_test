<?php

$connection = $entityManager->getConnection();


$sql = "WITH raiting as (SELECT task_id, tasks.title as  title_task , COUNT(TIMESTAMPDIFF(HOUR, date_start, date_end)) as hour_count  
FROM timesheets 
JOIN tasks on  tasks.id = timesheets.task_id GROUP BY task_id 
ORDER BY hour_count DESC LIMIT 5) select row_number() over() as position, title_task, hour_count from raiting";

$result = $connection->executeQuery($sql)->fetchAll();

$table = new Console_Table();
$table->setHeaders(array_keys($result[0]));
foreach($result as $row) {
    $table->addRow(array_values($row));
}
echo $table->getTable();



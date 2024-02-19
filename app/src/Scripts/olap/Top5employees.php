<?php

$sql = 
"WITH raiting as (
    SELECT e.id id, e.name name, COUNT(TIMESTAMPDIFF(HOUR, ti.date_start, ti.date_end)) as work_time  
    FROM timesheets ti
    JOIN employees e on e.id = ti.employer_id
    GROUP BY e.id
    ORDER BY work_time DESC
    LIMIT 5
) 
SELECT row_number() over() as position, id , name, work_time  from raiting";

$result = $connection->executeQuery($sql)->fetchAll();

$table = new Console_Table();
$table->setHeaders(array_keys($result[0]));
foreach($result as $row) {
    $table->addRow(array_values($row));
}
echo $table->getTable();

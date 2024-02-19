<?php

$sql = "WITH raiting as (SELECT ti.task_id, ta.title as  title_task , 
ROUND(COUNT(TIMESTAMPDIFF(HOUR, ti.date_start, ti.date_end)) * AVG(p.wage)) as total_cost  
FROM timesheets ti
JOIN tasks ta on  ta.id = ti.task_id
JOIN employees e on e.id = ti.employer_id
JOIN positions p on p.id = e.position_id
GROUP BY ti.task_id 
ORDER BY total_cost DESC 
LIMIT 5) 
SELECT row_number() over() as position, title_task, total_cost from raiting";

$result = $connection->executeQuery($sql)->fetchAll();

$table = new Console_Table();
$table->setHeaders(array_keys($result[0]));
foreach($result as $row) {
    $table->addRow(array_values($row));
}
echo $table->getTable();


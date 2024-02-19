<?php
use App\Entities\Position;

require_once __DIR__ . '/bootstrap.php';

$command = $argv[1];
$argument = $argv[2];

if ($command === 'import') {
    switch ($argument) {
        case 'positions.csv':
            require_once(__DIR__ . '/src/Scripts/import/positions_import.php');
            break;
        case 'employees.csv':
            require_once(__DIR__ . '/src/Scripts/import/employees_import.php');
            break;
        case 'timesheet.csv':
            require_once(__DIR__ . '/src/Scripts/import/timesheets_import.php');
            break;
    }
} else if ($command === 'get') {
    $name = $argument;
    require_once(__DIR__ . '/src/Scripts/oltp/timesheet_get.php');
} else if ($command === 'remove') {
    $id = $argument;
    require_once(__DIR__ . '/src/Scripts/oltp/timesheet_remove.php');
} else if ($command === 'report') {
    $report = $argument;
    switch ($argument) {
        case 'Top5longTasks':
            require_once(__DIR__ . '/src/Scripts/olap/Top5longTasks.php');
            break;
        case 'Top5costTasks':
            require_once(__DIR__ . '/src/Scripts/olap/Top5costTasks.php');
            break;
        case 'Top5employees':
            require_once(__DIR__ . '/src/Scripts/olap/Top5employees.php');
            break;
    }
} else {
    echo 'Command not found!' . "\n";
}

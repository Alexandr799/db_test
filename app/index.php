<?php
use App\Entities\Position;

require_once __DIR__ . '/bootstrap.php';

$command = $argv[1];
$argument = $argv[2];

if ($command === 'import') {
    switch ($argument) {
        case 'positions.csv':
            require_once(__DIR__ . '/src/Scripts/positions_import.php');
            break;
        case 'employees.csv':
            require_once(__DIR__ . '/src/Scripts/employees_import.php');
            break;
    }
}



// var_dump($argv);
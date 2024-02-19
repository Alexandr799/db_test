<?php
use App\Entities\Employer;
use App\Entities\Position;


$filePath = __DIR__ . '/../../../csv/employees.csv';

$file = @fopen($filePath, 'r');
$importedCount = 0;
$noImportedCount = 0;
if (!empty($file)) {
    $employerRepository = $entityManager->getRepository(Employer::class);
    while (($line = fgets($file)) !== false) {
        $line = explode(',', $line);
        $name = trim($line[0]); 
        $position = trim($line[1]);
        $created = $employerRepository
            ->createEmployerByNameAndPositionName($name, $position);
        if ($created) {
            $importedCount++;
        } else {
            $noImportedCount++;
        }
    }

    fclose($file);
    echo "Imported $importedCount employees\n";
    if ($noImportedCount > 0) {
        echo "Incorrect: $noImportedCount\n";
    }

} else {
    echo "Imported 0 positions\n";
    echo "Can not read file positions.csv\n";
}
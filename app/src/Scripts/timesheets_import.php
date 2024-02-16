<?php
use App\Entities\Position;
use App\Entities\Task;
use App\Entities\TimeSheet;
use Doctrine\ORM\EntityManager;


$filePath = __DIR__ . '/../../csv/timesheet.csv';


$file = @fopen($filePath, 'r');
$importedCount = 0;
$noImportedCount = 0;
$timesheetRepository = $entityManager->getRepository(TimeSheet::class);
if (!empty($file)) {
    while (($line = fgets($file)) !== false) {
        $timesheetRepository = $entityManager->getRepository(TimeSheet::class);
        $line = explode(',', $line);
        $data = [
            'username' => trim($line[1]),
            'task_title' => trim($line[0]),
            'date_start' => $line[2],
            'date_end' => $line[3]
        ];
        $created = $timesheetRepository->createTimeSheetsWithTaskWithEmployerName($data);
        if ($created) {
            $importedCount++;
        } else {
            $noImportedCount++;
        }
    }

    fclose($file);
    echo "Imported $importedCount positions\n";
    if ($noImportedCount > 0) {
        echo "Incorrect: $noImportedCount\n";
    }

} else {
    echo "Imported 0 positions\n";
    echo "Can not read file positions.csv\n";
}
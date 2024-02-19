<?php
use App\Entities\Position;


$filePath = __DIR__ . '/../../csv/positions.csv';

$file = @fopen($filePath, 'r');
$importedCount = 0;
$noImportedCount = 0;
if (!empty($file)) {
    $positionRepository = $entityManager->getRepository(Position::class);
    while (($line = fgets($file)) !== false) {
        $line = explode(',',$line );
        $data = ['title' => trim($line[0]), "wage" => trim($line[1])];
        $created = $positionRepository->saveOne($data);
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
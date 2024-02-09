<?php
use App\Entities\Position;
use App\Entities\Task;


$filePath = __DIR__ . '/../../csv/timesheet.csv';


$taskRepository = $entityManager->getRepository(Task::class);
$res = $taskRepository->createOrSelect(['title'=>'asd1']);
var_dump($res->getId());
// $file = @fopen($filePath, 'r');
// $importedCount = 0;
// $noImportedCount = 0;
// if (!empty($file)) {
//     $positionRepository = $entityManager->getRepository(Position::class);
//     while (($line = fgets($file)) !== false) {
//         $line = explode(',',$line );
//         $data = ['title' => trim($line[0]), "wage" => trim($line[1])];
//         $created = $positionRepository->saveOne($data);
//         if ($created) {
//             $importedCount++;
//         } else {
//             $noImportedCount++;
//         }
//     }

//     fclose($file);
//     echo "Imported $importedCount positions\n";
//     if ($noImportedCount > 0) {
//         echo "Incorrect: $noImportedCount\n";
//     }

// } else {
//     echo "Imported 0 positions\n";
//     echo "Can not read file positions.csv\n";
// }
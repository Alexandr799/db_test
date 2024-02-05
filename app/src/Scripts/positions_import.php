<?php
use App\Entities\Position;


$filePath = __DIR__ . '/../../positions.csv';

$file = fopen($filePath, 'r');

if ($file) {
    $employerRepository = $entityManager->getRepository(Position::class);
    while (($line = fgets($file)) !== false) {
        $line = explode(',', $line);
        $q = $employerRepository->saveOne([
            'title' => $line[0],
            'wage' => $line[1]
        ]);
        var_dump($q);
    }

    fclose($file);
} else {
    echo "Не удалось открыть файл.";
}
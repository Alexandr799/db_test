<?php
use App\Entities\TimeSheet;


$timesheetRepository = $entityManager
    ->getRepository(TimeSheet::class);

var_dump($name);
$res = $timesheetRepository->getTimesheetsByEmployerName($name);  

var_dump($res);

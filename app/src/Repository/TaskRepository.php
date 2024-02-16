<?php

namespace App\Repository;

use App\Entities\Task;
use App\Entities\TimeSheet;
use \Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class TaskRepository extends BaseRepository
{
    public function createEntity(array $item)
    {
        $task = new Task();
        $task->setTitle($item['title']);
        return $task;
    }
}
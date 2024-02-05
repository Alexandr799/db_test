<?php

namespace App\Repository;

use App\Entities\Task;

class TaskRepository extends BaseRepository
{
    public function createEntity(array $item)
    {
        $task = new Task();
        $task->setTitle($item['title']);
        return $task;
    }
}
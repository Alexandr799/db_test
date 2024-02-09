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

    public function createOrSelect($item)
    {
        $title = $item['title'];
        $em = $this->getEntityManager();

        $task = $this->createEntity([
            'title' => $title
        ]);
        try {
            $em->persist($task);
            $em->flush();

        } catch (UniqueConstraintViolationException $e) {
            $task = $this->findOneBy(['title' => $title]);
            return $task;
        }

        return $task;
    }
}
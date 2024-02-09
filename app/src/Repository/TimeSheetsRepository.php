<?php

namespace App\Repository;

use App\Entities\Employer;
use App\Entities\Task;
use App\Entities\TimeSheet;

class TimeSheetsRepository extends BaseRepository
{
    public function createEntity(array $item)
    {
        $timesheet = new TimeSheet();
        $timesheet
            ->setEmployer($item['employer'])
            ->setTask($item['task'])
            ->setStart($item['date_start'])
            ->setEnd($item['date_end']);

        return $timesheet;
    }

    public function createTimeSheetsWithTaskWithEmployerName(array $data): bool
    {
        $em = $this->getEntityManager();
        $employerRepository = new EmployerRepository($em, $em->getClassMetadata(Employer::class));
        $taskRepositiry = new TaskRepository($em, $em->getClassMetadata(Task::class));
        $em->beginTransaction();
        try {
            $employer = $employerRepository->findOneBy(['name' => $data['username']]);
            if (empty($employer)) {
                throw new \Exception("Пользователя для задачи не найдено!");
            }

            $task = $taskRepositiry->createOrSelect(['title' => $data['task_title']]);

            $timesheet = $this->createEntity([
                'employer' => $employer,
                'task' => $task,
                'date_start' => $data['date_start'],
                'date_end' => $data['date_end']
            ]);
            $em->persist($timesheet);
            $em->flush();
            $em->commit();
            return true;
        } catch (\Throwable $e) {
            $em->rollback();
            return false;
        }
    }
}
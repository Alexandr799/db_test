<?php

namespace App\Repository;

use App\Entities\Employer;
use App\Entities\Task;
use App\Entities\TimeSheet;
use App\Services\Logger;

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
        $em = $this->getOpenEntityManager();
        $employerRepository = $em->getRepository(Employer::class);
        $taskRepositiry = $em->getRepository(Task::class);

        $em->beginTransaction();
        try {
            $employer = $employerRepository->findOneBy(['name' => $data['username']]);
            if (empty($employer)) {
                throw new \Exception("Пользователя для задачи не найдено!");
            }

            $selectTask = ['title' => $data['task_title']];
            $task = $taskRepositiry->findOneBy($selectTask);
            if (empty($task)) {
                $task = $taskRepositiry->createEntity($selectTask);
            }
            $em->persist($task);

            $timesheet = $this->createEntity([
                'employer' => $employer,
                'task' => $task,
                'date_start' => new \DateTime($data['date_start']),
                'date_end' => new \DateTime($data['date_end'])
            ]);

            $em->persist($timesheet);
            $em->flush();
            $em->commit();
            return true;
        } catch (\Throwable $e) {
            $em->rollback();
            Logger::logError($e->getMessage());
            return false;
        }
    }


    public function getTimesheetsByEmployerName(string $name)
    {
        $connection = $this->getEntityManager()->getConnection();
        $data = $connection->createQueryBuilder()
            ->select('t.id', 't.task_id','e.name as employer_name ', 't.date_start', 't.date_end')
            ->from('timesheets', 't')
            ->join('t', 'employees', 'e', 'e.id = t.employer_id')
            ->where('e.name = :name')
            ->orderBy('t.date_start', 'asc')
            ->setParameter('name', $name)
            ->execute()
            ->fetchAll();

        return $data;
    }
}
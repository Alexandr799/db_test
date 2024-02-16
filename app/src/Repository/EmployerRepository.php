<?php

namespace App\Repository;

use App\Entities\Employer;
use App\Entities\Position;
use App\Services\Logger;

class EmployerRepository extends BaseRepository
{
    public function createEntity(array $item)
    {
        $employer = new Employer();
        $employer->setName($item['name'])
            ->setPosition($item['position']);
        return $employer;
    }

    public function createEmployerByNameAndPositionName(string $name, string $positionTitle): bool
    {
        $em = $this->getOpenEntityManager();
        $positionRepository = new PositionRepository($em, $em->getClassMetadata(Position::class));
        $em->beginTransaction();
        try {
            $position = $positionRepository->findOneBy(['title' => $positionTitle]);
            if (empty($position))
                throw new \Exception("Данной позиции - $positionTitle не существует!");

            $this->saveOne(['name' => $name, 'position' => $position]);
            $em->commit();
            return true;
        } catch (\Throwable $e) {
            $em->rollback();
            Logger::logError($e->getMessage());
            return false;
        }
    }
}
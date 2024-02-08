<?php

namespace App\Repository;

use App\Entities\Employer;
use App\Entities\Position;
use Doctrine\ORM\EntityRepository;

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
        $em = $this->getEntityManager();
        $positionRepository = $em->getRepository(Position::class);
        // $em->beginTransaction();
        // try {
            $position = $positionRepository->findOneBy(['title' => $positionTitle]);
            if (empty($position))
                throw new \Exception("Данной позиции - $positionTitle не существует!");
            $employer = new Employer();
            $employer->setName($name)
                ->setPosition($position);
            
            $em->persist($employer);
            $em->flush();
            
            // $em->commit();

            return true;
        // } catch (\Throwable $e) {
        //     $em->rollback();
        //     var_dump($e->getMessage());
        //     return false;
        // }
    }
}
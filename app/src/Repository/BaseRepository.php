<?php

namespace App\Repository;

use App\Entities\Position;
use Doctrine\ORM\EntityRepository;

abstract class BaseRepository extends EntityRepository
{
    public function saveMany(array $list): bool
    {
        try {
            $em = $this->getEntityManager();
            foreach ($list as $item) {
                $entity = $this->createEntity($item);
                $em->persist($entity);
            }
            $em->flush();
            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function saveOne(array $item):bool
    {
        try {
            $em = $this->getEntityManager();
            $entity = $this->createEntity($item);
            $em->persist($entity);
            $em->flush();
            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }

    abstract public function createEntity(array $item);
}
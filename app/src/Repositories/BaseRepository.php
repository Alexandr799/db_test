<?php

namespace App\Repository;

use App\Entities\Position;
use Doctrine\ORM\EntityRepository;

abstract class BaseRepository extends EntityRepository
{
    public function saveMany(array $list)
    {
        $em = $this->getEntityManager();
        foreach ($list as $item) {
            $entity = $this->createEntity($item);
            $em->persist($entity);
        }
        $em->flush();
    }

    abstract public function createEntity(array $item);
}
<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use \Doctrine\DBAL\Exception\UniqueConstraintViolationException;

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

    public function createOrSelect(array $item, array $select)
    {
        $em = $this->getEntityManager();
        $entity = $this->createEntity($item);
        try {
            $em->persist($entity);
            $em->flush();
            return $entity;

        } catch (UniqueConstraintViolationException $e) {
            $entity = $this->findOneBy($select);
            return $entity;
        }
    }

    abstract public function createEntity(array $item);
}
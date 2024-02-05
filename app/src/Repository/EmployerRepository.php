<?php

namespace App\Repository;

use App\Entities\Employer;
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
}
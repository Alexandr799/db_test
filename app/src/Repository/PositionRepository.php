<?php

namespace App\Repository;

use App\Entities\Position;

class PositionRepository extends BaseRepository
{
    public function createEntity(array $item)
    {
        $position = new Position();
        $position->setTitle($item['title'])
            ->setWage($item['wage']);
        return $position;
    }
}
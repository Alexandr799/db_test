<?php

namespace App\Entities;

use App\Repository\PositionRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'positions')]
#[ORM\Entity(repositoryClass: PositionRepository::class)]

class Position
{
    #[ORM\Column(type: 'string', length: 255, name: 'title', nullable: false)]
    private string $title;
}
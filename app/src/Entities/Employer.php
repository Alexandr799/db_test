<?php

namespace App\Entities;
use App\Repository\EmployerRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'employers')]
#[ORM\Entity(repositoryClass: EmployerRepository::class)]
class Employer
{
    #[ORM\Column(type: 'string', length: 255, name: 'name', nullable: false)]
    private string $name;
}
<?php

namespace App\Entities;

use App\Repository\EmployerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'employees')]
#[ORM\Entity(repositoryClass: EmployerRepository::class)]
class Employer
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer', options: ["unsigned" => true])]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $name;

    #[ORM\ManyToOne(targetEntity: Position::class, inversedBy: 'emploees')]
    #[ORM\JoinColumn(nullable: false, name: 'position_id', referencedColumnName: 'id')]
    private $position;

    #[ORM\JoinTable(name: 'timesheets')]
    #[ORM\JoinColumn(name: 'employer_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'task_id', referencedColumnName: 'id', unique: true)]
    #[ORM\ManyToMany(targetEntity: Task::class)]
    private Collection $tasks;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }


    public function getId()
    {
        return $this->id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPosition(Position $position)
    {
        $this->position = $position;
        return $this;
    }

    public function getPosition()
    {
        return $this->position;
    }

}
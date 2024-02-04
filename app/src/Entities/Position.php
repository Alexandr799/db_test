<?php

namespace App\Entities;

use App\Repository\PositionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'positions')]
#[ORM\Entity(repositoryClass: PositionRepository::class)]

class Position
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer', options: ["unsigned" => true])]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: false, unique: true)]
    private string $title;

    #[ORM\Column(type: 'integer', options: ["unsigned" => true])]
    private int $wage;

    #[ORM\OneToMany(mappedBy: 'position', targetEntity: Employer::class)]
    private ArrayCollection $emploees;


    public function __construct()
    {
        $this->emploees = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setWage(int $wage)
    {
        $this->wage = $wage;
        return $this;
    }

    public function getWage()
    {
        return $this->wage;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getEmployers()
    {
        return $this->emploees;
    }

}
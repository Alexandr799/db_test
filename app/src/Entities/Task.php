<?php

namespace App\Entities;

use App\Repository\TaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'tasks')]
#[ORM\Entity(repositoryClass: TaskRepository::class)]

class Task
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer', options: ["unsigned" => true])]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\Column(type: 'string', length: 255, name: 'title', nullable: false, unique: true)]
    private string $title;

    // #[ORM\ManyToMany(targetEntity: Employer::class, mappedBy: 'employers')]
    // private ArrayCollection $employers;

    // public function __construct()
    // {
    //     $this->employers = new ArrayCollection();
    // }

    public function getId()
    {
        return $this->id;
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
}
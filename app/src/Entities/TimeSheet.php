<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'timesheets')]
#[ORM\Entity(repositoryClass: TimeSheetsRepository::class)]
class TimeSheet
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer', options: ["unsigned" => true])]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\ManyToOne(targetEntity: Employer::class, inversedBy: 'employees')]
    #[ORM\JoinColumn(nullable: false, name: 'employer_id', referencedColumnName: 'id')]
    private Employer $employer;

    #[ORM\ManyToOne(targetEntity: Task::class, inversedBy: 'employees')]
    #[ORM\JoinColumn(nullable: false, name: 'employer_id', referencedColumnName: 'id')]
    private Task $task;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private \DateTime $date_start;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private \DateTime $date_end;


    public function getId()
    {
        return $this->id;
    }

    public function setEmployer(Employer $employer)
    {
        $this->employer = $employer;
        return $this;
    }

    public function setTask(Task $task)
    {
        $this->task = $task;
        return $this;
    }

    public function setStart(\DateTime $date)
    {
        $this->date_start = $date;
        return $this;
    }

    public function setEnd(\DateTime $date)
    {
        $this->date_end = $date;
        return $this;
    }
}
<?php

namespace App\Entities;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'user')]
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $user_id = null;

    #[ORM\Column(type: 'string', length: 255, name: 'first_name')]
    private string $username;


    #[ORM\Column(type: 'boolean', name: 'is_active')]
    private bool $active;


    public function getUsername(): string
    {
        return $this->username;
    }

    public function getId(): string
    {
        return $this->user_id;
    }

    public function setActive(bool $active)
    {
        $this->active = $active;
    }

    public function getActive()
    {
        return $this->active;
    }


}
<?php

namespace App\Entity;

use App\Repository\StatesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatesRepository::class)
 */
class States
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="bigint")
     */
    private $state_id;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStateId(): ?string
    {
        return $this->state_id;
    }

    public function setStateId(string $state_id): self
    {
        $this->state_id = $state_id;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}

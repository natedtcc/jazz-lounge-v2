<?php

namespace App\Entity;

use App\Repository\ShippingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShippingRepository::class)
 */
class Shipping
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $shipping_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $carrier;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $cost;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShippingId(): ?int
    {
        return $this->shipping_id;
    }

    public function setShippingId(int $shipping_id): self
    {
        $this->shipping_id = $shipping_id;

        return $this;
    }

    public function getCarrier(): ?string
    {
        return $this->carrier;
    }

    public function setCarrier(string $carrier): self
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function getCost(): ?string
    {
        return $this->cost;
    }

    public function setCost(string $cost): self
    {
        $this->cost = $cost;

        return $this;
    }
}

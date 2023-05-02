<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
    const FOOD_PRODUCT = 'food';
    public function __construct($name, $type, $price) {
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
    }
    public function computeTVA(): float{
        if ($this->price < 0) {
            throw new \Exception('The TVA cannot be negative.');
        }
        if (self::FOOD_PRODUCT == $this->type) {
            return $this->price * 0.055;
        }
        return $this->price * 0.196;
    }

}

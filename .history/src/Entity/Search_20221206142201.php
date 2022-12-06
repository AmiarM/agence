<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
class Search{
    /**
     *
     * @var int | null
     */
    #[Assert\Range(
        min: 10,
        max: 400,
        notInRangeMessage: 'You must be between {{ min }}m² and {{ max }}m² surface to enter',
    )]
    private $minPrice;
    /**
     *
     * @var int | null
     */
    #[Assert\Range(
        min: 50000,
        max: 10000000,
        notInRangeMessage: 'You must be between {{ min }}€ and {{ max }}€ price to enter',
    )]
    private $maxSurface;
    /**
     *
     * @var ArrayCollection
     */
    private $options;
    

    public function __construct()
    {
        $this->options=new ArrayCollection();
    }

    /**
     * Get | null
     */
    public function getMinPrice(): int|null
    {
        return $this->minPrice;
    }

    /**
     * Set | null
     */
    public function setMinPrice(int $minPrice): self
    {
        $this->minPrice = $minPrice;

        return $this;
    }

    /**
     * Get | null
     */
    public function getMaxSurface(): int |null
    {
        return $this->maxSurface;
    }

    /**
     * Set | null
     */
    public function setMaxSurface(int $maxSurface): self
    {
        $this->maxSurface = $maxSurface;

        return $this;
    }
}
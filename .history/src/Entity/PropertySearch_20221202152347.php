<?php

namespace App\Entity;


class PropertySearch{
    /**
     *
     * @var int | null
     */
    private $maxPrice;
    /**
     *
     * @var int | null
     */
    private $minSurface;

    /**
     * Get | null
     */
    public function getMaxPrice(): int
    {
        return $this->maxPrice;
    }

    /**
     * Set | null
     */
    public function setMaxPrice(int $maxPrice): self
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }
}
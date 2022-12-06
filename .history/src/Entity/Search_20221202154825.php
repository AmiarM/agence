<?php

namespace App\Entity;


class Search{
    /**
     *
     * @var int | null
     */
    private $minPrice;
    /**
     *
     * @var int | null
     */
    private $maxSurface;

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

    /**
     * Get | null
     */
    public function getMinSurface(): int
    {
        return $this->minSurface;
    }

    /**
     * Set | null
     */
    public function setMinSurface(int $minSurface): self
    {
        $this->minSurface = $minSurface;

        return $this;
    }
}
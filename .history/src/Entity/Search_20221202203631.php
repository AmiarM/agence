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
    public function getMinPrice(): int
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
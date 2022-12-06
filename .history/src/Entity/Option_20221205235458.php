<?php

namespace App\Entity;

use App\Repository\OptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OptionRepository::class)]
#[ORM\Table(name: '`option`')]
class Option
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Property::class, mappedBy: 'propertys')]
    private Collection $propertys;

    public function __construct()
    {
        $this->propertys = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Property>
     */
    public function getPropertys(): Collection
    {
        return $this->propertys;
    }

    public function addProperty(Property $property): self
    {
        if (!$this->propertys->contains($property)) {
            $this->propertys->add($property);
        }

        return $this;
    }

    public function removeProperty(Property $property): self
    {
        $this->propertys->removeElement($property);

        return $this;
    }
}
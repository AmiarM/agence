<?php

namespace App\Entity;

use DateTimeImmutable;
use Cocur\Slugify\Slugify;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PropertyRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PropertyRepository::class)]
class Property
{
    const HEAT=[
        1=>'GAZ',
        2=>'ELECTRIC'
    ];
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 3,
        max: 50,
        minMessage: 'Title must be at least {{ limit }} characters long',
        maxMessage: 'Title name cannot be longer than {{ limit }} characters',
    )]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT,nullable:true)]
    #[Assert\Length(
        min: 10,
        max: 500,
        minMessage: 'Description must be at least {{ limit }} characters long',
        maxMessage: 'Description cannot be longer than {{ limit }} characters',
    )]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\Range(
        min: 10,
        max: 40,
        notInRangeMessage: 'You must be between {{ min }}m² and {{ max }}m² surface to enter',
    )]
    private ?int $surface = null;

    #[ORM\Column]
    #[Assert\Range(
        min: 1,
        max: 40,
        notInRangeMessage: 'You must be between {{ min }} and {{ max }} rooms to enter',
    )]
    private ?int $rooms = null;

    #[ORM\Column]
    #[Assert\Range(
        min: 1,
        max: 40,
        notInRangeMessage: 'You must be between {{ min }} and {{ max }} bedrooms to enter',
    )]
    private ?int $bedrooms = null;

    #[ORM\Column]
    #[Assert\Range(
        min: 1,
        max: 40,
        notInRangeMessage: 'You must be between {{ min }} and {{ max }} floor to enter',
    )]
    private ?int $floor = null;

    #[ORM\Column]
    #[Assert\Range(
        min: 50000,
        max: 10000000,
        notInRangeMessage: 'You must be between {{ min }}€ and {{ max }}€ price to enter',
    )]
    private ?int $price = null;

    #[ORM\Column]
    private ?int $heat = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 3,
        max: 40,
        minMessage: 'Description must be at least {{ limit }} characters long',
        maxMessage: 'Description cannot be longer than {{ limit }} characters',
    )]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $postal_code = null;

    #[ORM\Column]
    private ?bool $sold = false;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    public function __construct()
    {
        $this->created_at=new DateTimeImmutable();
        $this->sold=0; 
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    public function setRooms(int $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getBedrooms(): ?int
    {
        return $this->bedrooms;
    }

    public function setBedrooms(int $bedrooms): self
    {
        $this->bedrooms = $bedrooms;

        return $this;
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(int $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getHeat(): ?int
    {
        return $this->heat;
    }

    public function setHeat(int $heat): self
    {
        $this->heat = $heat;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function isSold(): ?bool
    {
        return $this->sold;
    }

    public function setSold(bool $sold): self
    {
        $this->sold = $sold;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getFormattedPrice(){
        return number_format($this->price,0,'',' ');
    }

    public function getSlug(){
        return trim(strtolower((new Slugify())->slugify($this->title)),"");
    }

    public function getHeatType(){
        return self::HEAT[$this->heat];
    }
}
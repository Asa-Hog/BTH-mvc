<?php

namespace App\Entity;

use App\Repository\CityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CityRepository::class)]
class City
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Latitude;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Longitude;

    #[ORM\OneToOne(mappedBy: 'city', targetEntity: Weather::class, cascade: ['persist', 'remove'])]
    private $weather;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(?string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->Latitude;
    }

    public function setLatitude(?string $Latitude): self
    {
        $this->Latitude = $Latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->Longitude;
    }

    public function setLongitude(?string $Longitude): self
    {
        $this->Longitude = $Longitude;

        return $this;
    }

    public function getWeather(): ?Weather
    {
        return $this->weather;
    }

    public function setWeather(Weather $weather): self
    {
        // set the owning side of the relation if necessary
        if ($weather->getCity() !== $this) {
            $weather->setCity($this);
        }

        $this->weather = $weather;

        return $this;
    }

    public function toString(): string
    {

        return "stad";
    }
}

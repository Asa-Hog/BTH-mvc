<?php

namespace App\Entity;

use App\Repository\WeatherRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeatherRepository::class)]
class Weather
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'array')]
    private $years = [];

    #[ORM\Column(type: 'array')]
    private $temperature = [];

    #[ORM\Column(type: 'array')]
    private $precipitation = [];

    #[ORM\Column(type: 'integer')]
    private $cityId;

    #[ORM\Column(type: 'array')]
    private $frost = [];

    #[ORM\Column(type: 'array')]
    private $summer = [];

    #[ORM\Column(type: 'array')]
    private $precDays = [];

    #[ORM\OneToOne(inversedBy: 'weather', targetEntity: City::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $city;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYears(): ?array
    {
        return $this->years;
    }

    public function setYears(array $years): self
    {
        $this->years = $years;

        return $this;
    }

    public function getTemperature(): ?array
    {
        return $this->temperature;
    }

    public function setTemperature(array $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getPrecipitation(): ?array
    {
        return $this->precipitation;
    }

    public function setPrecipitation(array $precipitation): self
    {
        $this->precipitation = $precipitation;

        return $this;
    }

    public function getCityId(): ?int
    {
        return $this->cityId;
    }

    public function setCityId(int $cityId): self
    {
        $this->cityId = $cityId;

        return $this;
    }

    public function getFrost(): ?array
    {
        return $this->frost;
    }

    public function setFrost(array $frost): self
    {
        $this->frost = $frost;

        return $this;
    }

    public function getSummer(): ?array
    {
        return $this->summer;
    }

    public function setSummer(array $summer): self
    {
        $this->summer = $summer;

        return $this;
    }

    public function getPrecDays(): ?array
    {
        return $this->precDays;
    }

    public function setPrecDays(array $precDays): self
    {
        $this->precDays = $precDays;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(City $city): self
    {
        $this->city = $city;

        return $this;
    }
}

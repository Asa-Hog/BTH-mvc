<?php

namespace App\Card;

class Card
{
    /**
    * Describes a card
    */
    private string $value;
    private string $color;
    private string $char;

    public function __construct(string $char, string $color, string $value)
    {
        $this->color = $color;
        $this->char = $char;
        $this->value = $value;
    }

    public function getDetails(): array
    {
        return  [$this->char, $this->color, $this->value]; // Kolla att tillägget sista elementet inte förstör nåt
    }

    public function toString(): string
    {
        return  $this->color ." " .  $this->char;
    }
}

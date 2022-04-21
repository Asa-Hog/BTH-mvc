<?php

namespace App\Card;

/**
* Describes a card
*/
class Card
{
    private string $value;
    private string $color;
    private string $char;

    /**
    * Constructor for the card class. Sets color, character and value to a card.
    */
    public function __construct(string $char, string $color, string $value)
    {
        $this->color = $color;
        $this->char = $char;
        $this->value = $value;
    }

    /**
    * Gets details from a card
    * @return
    */
    public function getDetails(): array
    {
        return  [$this->char, $this->color, $this->value]; // Kolla att tillägget sista elementet inte förstör nåt
    }

    /**
    * Describes a card with a string
    */
    public function toString(): string
    {
        return  $this->color ." " .  $this->char;
    }
}

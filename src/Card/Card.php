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
    * @param string $char character of the card
    * @param string $color color of the card
    * @param string $value value of the card
    */
    public function __construct(string $char, string $color, string $value)
    {
        $this->color = $color;
        $this->char = $char;
        $this->value = $value;
    }

    /**
    * Gets details from a card
    * @return array with three elements; character, color and value of a card
    */
    public function getDetails(): array
    {
        return  [$this->char, $this->color, $this->value];
    }

    /**
    * Describes a card with a string
    * @return string that describes a card
    */
    public function toString(): string
    {
        return  $this->color . " " .  $this->char;
    }
}

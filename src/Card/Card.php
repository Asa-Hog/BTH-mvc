<?php

namespace App\Card;

class Card
{
    /**
    * Describes a card
    */
    private string $value;
    private string $color;

    public function __construct(string $value, string $color)
    {
        $this->value = $value;
        $this->color = $color;
    }

    public function get_details(): array
    {
        return  [$this->value, $this->color];
    }

    public function to_string(): string
    {
        return  $this->color ." " .  $this->value;
    }
}

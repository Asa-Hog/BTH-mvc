<?php

namespace App\Card;

class CardHand
{
    /**
    * Describes a card hand
    */
    private array $cards = []; // Finns en array cards

    public function __construct()
    {
        // $this->cards = $cards; // tillhör detta objekt
    }


    public function add_card(Card $card): void
    {
        array_push($this->cards, $card);
    }

    public function get_cards(): array
    {
        return $this->cards;
    }
}

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


    public function addCard(Card $card): void
    {
        array_push($this->cards, $card);
    }

    public function getCards(): array
    {
        return $this->cards;
    }
}

<?php

namespace App\Card;

/**
* Describes a card hand
*/
class CardHand
{
    private array $cards; // Finns en array cards

    public function __construct()
    {
        $this->cards = []; // tillhör detta objekt
    }

    /**
    * Adds a card to the cardhand
    */
    public function addCard(Card $card): void
    {
        array_push($this->cards, $card);
    }

    /**
    * Gets the cards from the cardhand
    */
    public function getCards(): array
    {
        return $this->cards;
    }
}

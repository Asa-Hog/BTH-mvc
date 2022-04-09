<?php

namespace App\Card;

class Deck2 extends Deck
{
    /**
    * Describes a deck of cards with 2 jokers
    */

    public function __construct()
    {
        parent::__construct();

        // Lägg även till två jokrar
        array_push($this->cards, new Card("J", "♥"));
        array_push($this->cards, new Card("J", "☘"));
    }
}

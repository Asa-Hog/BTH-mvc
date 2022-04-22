<?php

namespace App\Card;

    /**
    * Describes a deck of cards with 2 jokers
    */
class Deck2 extends Deck
{
    /**
    * Constructor of the class
    */
    public function __construct()
    {
        parent::__construct();

        // Lägg även till två jokrar
        array_push($this->cards, new Card("J", "♥", "11"));
        array_push($this->cards, new Card("J", "☘", "11"));
    }
}

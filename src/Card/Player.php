<?php

namespace App\Card;

class Player
{
    /**
    * Describes a player
    */
    private CardHand $cardhand;

    // public function __construct(CardHand $cardhand)
    // {
    //     $this->cardhand = $cardhand;
    // }

    public function add_cardhand(CardHand $cardhand): void
    {
        $this->cardhand = $cardhand;
    }

    public function get_cardhand(): CardHand
    {
        return $this->cardhand;
    }
}

<?php

namespace App\Card;

class PlayerKmom02
{
    /**
    * Describes a player
    */
    private CardHand $cardhand;

    // public function __construct(CardHand $cardhand)
    // {
    //     $this->cardhand = $cardhand;
    // }

    public function addCardhand(CardHand $cardhand): void
    {
        $this->cardhand = $cardhand;
    }

    public function getCardhand(): CardHand
    {
        return $this->cardhand;
    }
}

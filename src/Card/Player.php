<?php

namespace App\Card;

class Player
{
    /**
    * Describes a player
    */
    private CardHand $cardhand;
    private int $points;

    public function __construct()
    {
        $this->points = 0;
    }

    public function addCardhand(CardHand $cardhand): void
    {
        $this->cardhand = $cardhand;
    }

    public function getCardhand(): CardHand
    {
        return $this->cardhand;
    }

    // public function reset_cardhand(): void
    // {
    //     $this->cardhand = null;
    // }

    public function setPoints(int $points): void
    {
        $this->points = $this->points + $points;
    }

    public function resetPoints(): void
    {
        $this->points = 0;
    }

    public function getPoints(): int
    {
        return $this->points;
    }
}

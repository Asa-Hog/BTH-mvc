<?php

namespace App\Card;

/**
* Describes a player
*/
class Player
{
    private CardHand $cardhand;
    private int $points;

    /*
    * Constructor. Gives player 0 points.
    */
    public function __construct()
    {
        $this->points = 0;
    }

    /*
    * Adds a cardhand to the player
    */
    public function addCardhand(CardHand $cardhand): void
    {
        $this->cardhand = $cardhand;
    }

    /*
    * Gets the player's cardhand
    */
    public function getCardhand(): CardHand
    {
        return $this->cardhand;
    }

    /*
    * Set points
    */
    public function setPoints(int $points): void
    {
        $this->points = $this->points + $points;
    }

    /*
    * Resets points for the player
    */
    public function resetPoints(): void
    {
        $this->points = 0;
    }

    /*
    * Get player's points
    */
    public function getPoints(): int
    {
        return $this->points;
    }
}

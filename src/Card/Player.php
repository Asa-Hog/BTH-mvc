<?php

namespace App\Card;

/**
* Describes a player
*/
class Player
{
    private CardHand $cardhand;
    private int $points;

    /**
    * Constructor. Gives player 0 points.
    */
    public function __construct()
    {
        $this->points = 0;
        $this->cardhand = new CardHand();
    }

    /**
    * Adds a cardhand to the player
    * @param CardHand $cardhand that corresponds to the player
    */
    public function addCardhand(CardHand $cardhand): void
    {
        $this->cardhand = $cardhand;
    }

    /**
    * Gets the player's cardhand
    * @return CardHand The cardhand of the player
    */
    public function getCardhand(): CardHand
    {
        return $this->cardhand;
    }

    /**
    * Set points
    * @param int $points The points the player got
    */
    public function setPoints(int $points): void
    {
        $this->points = $this->points + $points;
    }

    /**
    * Resets points for the player
    */
    public function resetPoints(): void
    {
        $this->points = 0;
    }

    /**
    * Get player's points
    * @return int The points of the player
    */
    public function getPoints(): int
    {
        return $this->points;
    }
}

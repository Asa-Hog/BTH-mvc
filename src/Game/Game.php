<?php

namespace App\Game;

use App\Card\Player;
use App\Card\Deck;

class Game
{
    private Player $player;
    private Player $bank;
    private Deck $deck;
    private string $winner;
    private string $message;

    /**
    * Constructor for the class
    * @param Deck $deck Tha deck corresponding to the game
    * @param Player $player The player in the game
    * @param Player $bank The bank in the game
    */
    public function __construct(Deck $deck, Player $player, Player $bank)
    {
        $this->deck = $deck;
        $this->player = $player;
        $this->bank = $bank;

        $this->setWinner("");
        $this->setMessage("");
    }

    /**
     * Method that starts the game - shuffles the deck
     */
    public function start(): void
    {
        $this->deck->getShuffledCards();
    }

    /**
     * Returns the bank of the game
     * @return Player $bank The bank in the game
     */
    public function getBank(): Player
    {
        return $this->bank;
    }

    /**
     * Returns the player of the game
     * @return Player $player The player in the game
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    /**
     * Gets the deck
     * @return Deck $deck The deck corresponding to the game
     */
    public function getDeck(): Deck
    {
        return $this->deck;
    }


    /**
     * Checks if player or bank got over 21 points and sets it to 0 in that case
     */
    public function checkPointsOver21(): void
    {
        if ($this->getPlayer()->getPoints() > 21) {
            $this->getPlayer()->resetPoints();
        }

        if ($this->getBank()->getPoints() > 21) {
            $this->getBank()->resetPoints();
        }
    }


    /**
     * Returns a message of who won the game
     * @return string Message containing who won the game
     */
    public function getMessage(): string
    {
        if ($this->getBank()->getPoints() == $this->getPlayer()->getPoints()) {
            $this->message = "It's a draw!";
        }

        if ($this->getBank()->getPoints() > $this->getPlayer()->getPoints()) {
            $this->message = "The winner is the bank!";
        }

        if ($this->getBank()->getPoints() < $this->getPlayer()->getPoints()) {
            $this->message = "The winner is the player!";
        }

        return $this->message;
    }

    /**
     * Sets a message to the game
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }


    /**
     * Gets the winner of the game
     * @return string $winner The winner of the game
     */
    public function getWinner(): string
    {
        return $this->winner;
    }

    /**
     * Sets when there is a winner of the game
     */
    public function setWinner(string $winner): void
    {
        $this->winner = $winner;
    }
}

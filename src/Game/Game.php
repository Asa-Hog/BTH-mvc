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

    public function __construct(Deck $deck, Player $player, Player $bank)
    {
        $this->deck = $deck;
        $this->player = $player;
        $this->bank = $bank;

        $this->setWinner("");
        $this->setMessage("");
    }

    public function start(): void
    {
        $this->deck->getShuffledCards();
    }

    public function getBank(): Player
    {
        return $this->bank;
    }

    public function getPlayer(): Player
    {
        return $this->player;
    }

    public function getDeck(): Deck
    {
        return $this->deck;
    }

    public function getMessage(): string
    {
        if ($this->getPlayer()->getPoints() > 21) {
            $this->getPlayer()->resetPoints();
        }

        if ($this->getBank()->getPoints() > 21) {
            $this->getBank()->resetPoints();
        }

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

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }


    public function getWinner(): string
    {
        return $this->winner;
    }

    public function setWinner(string $winner): void
    {
        $this->winner = $winner;
    }
}

<?php

namespace App\Card;

class Deck
{
    /**
    * Describes a deck of cards
    */
    private int $cardsInDeck;
    // private array $shuffledCards;
    // private int $numberOfCards;
    // private Card $card;
    protected array $cards;
    private array $color = ["♥", "☘", "♦", "♠"];
    private array $char = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "Kn", "Q", "K"];
    private array $value = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13"];
    private int $noOfColors;
    private int $noOfCards;

    public function __construct()
    {
        $this->cards = [];
        // $this->shuffledCards = [];
        $this->noOfColors = 4;
        $this->noOfCards = 13;


        for ($i = 0; $i < $this->noOfColors; $i++) {
            for ($j = 0; $j < $this->noOfCards; $j++) {
                array_push($this->cards, new Card($this->char[$j], $this->color[$i], $this->value[$j]));
            }
        }
    }

    public function getCards()
    {
        return $this->cards;
    }

    public function cardsInDeck()
    {
        $this->cardsInDeck = count($this->cards);
        return $this->cardsInDeck;
    }

    public function getShuffledCards()
    {
        // Shufflar kortleken med alla kort i
        shuffle($this->cards);
        return $this->cards;
    }

    public function draw()
    {
        // $shuffledCards = self::getShuffledCards($this->cards); // Slumpar korten i kortleken

        // if (count($this->cards)> 0) {
        //     // Tar bort sista kortet i arrayen och returnerar det
        //     $drawn = array_pop($this->cards);
        // } else {
        //     $drawn = null;
        // }

        // Blir detta samma sak som ovanstående?
        $drawn = null;

        if (count($this->cards)> 0) {
            // Tar bort sista kortet i arrayen och returnerar det
            $drawn = array_pop($this->cards);
        }

        $numberOfCards = count($this->cards);

        // $deck = $this->cards;

        return [$drawn, $numberOfCards];
    }
}

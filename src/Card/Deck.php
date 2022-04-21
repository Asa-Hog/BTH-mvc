<?php

namespace App\Card;

/**
* Describes a deck of cards
*/
class Deck
{
    private int $cardsInDeck;
    protected array $cards;
    private array $color = ["♥", "☘", "♦", "♠"];
    private array $char = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "Kn", "Q", "K"];
    private array $value = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13"];
    private int $noOfColors;
    private int $noOfCards;

    /*
    * Constructor for deck. Creates cards and puts them in an array.
    */
    public function __construct()
    {
        $this->cards = [];
        $this->noOfColors = 4;
        $this->noOfCards = 13;


        for ($i = 0; $i < $this->noOfColors; $i++) {
            for ($j = 0; $j < $this->noOfCards; $j++) {
                array_push($this->cards, new Card($this->char[$j], $this->color[$i], $this->value[$j]));
            }
        }
    }

    /*
    * Gets the cards in the deck
    */
    public function getCards()
    {
        return $this->cards;
    }

    /*
    * Returns number of cards left in the deck
    */
    public function cardsInDeck()
    {
        $this->cardsInDeck = count($this->cards);
        return $this->cardsInDeck;
    }

    /*
    * Shuffles the cards in the deck
    */
    public function getShuffledCards()
    {
        // Shufflar kortleken med alla kort i
        shuffle($this->cards);
        return $this->cards;
    }

    /*
    * Draws a card from the deck
    */
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

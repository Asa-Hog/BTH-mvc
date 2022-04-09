<?php

namespace App\Card;

class Deck
{
    /**
    * Describes a deck of cards
    */
    private int $cardsInDeck;
    private array $shuffledCards;
    private int $numberOfCards;
    private Card $card;
    protected array $cards;
    private array $color = ["♥", "☘", "♦", "♠"];
    private array $value = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "Kn", "Q", "K"];

    public function __construct()
    {
        $this->cards = [];
        $this->shuffledCards = [];

        for ($i = 0; $i < 4; $i++) {
            for ($j = 0; $j < 13; $j++) {
                array_push($this->cards, new Card($this->value[$j], $this->color[$i]));
            }
        }
    }

    public function get_cards()
    {
        return $this->cards;
    }

    public function cards_in_deck()
    {
        $this->cardsInDeck = count($this->cards);
        return $this->cardsInDeck;
    }

    public function get_shuffled_cards()
    {
        // Shufflar kortleken med alla kort i
        $cards = shuffle($this->cards);
        return $this->cards;
    }

    public function draw()
    {
        $shuffled_cards = self::get_shuffled_cards($this->cards); // Slumpar korten i kortleken

        if (count($this->cards)> 0) {
            // Tar bort sista kortet i arrayen och returnerar det
            $drawn = array_pop($this->cards);
        } else {
            $drawn = null;
        }

        $numberOfCards = count($this->cards);

        $deck = $this->cards;

        return [$drawn, $numberOfCards];
    }

    // public function draw_number() {
    //     $shuffled_cards = self::get_shuffled_cards($this->cards); // Slumpar korten i kortleken

    //     if (count($this->cards)> 0) {
    //         // Tar bort sista kortet i arrayen och returnerar det
    //         $drawn = array_pop($this->cards);
    //     } else {
    //         $drawn = null;
    //     }

    //     $numberOfCards = count($this->cards);

    //     $deck = $this->cards;

    //     return [$drawn, $numberOfCards];
    // }
}

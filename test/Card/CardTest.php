<?php

namespace App\Card;
use App\Card\Player;
use App\Card\CardHand;
use App\Game\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
 */
class CardTest extends TestCase
{
    
    /**
     * 
     */
    public function testCardCreateObject()
    {
        $card = new Card("5", "♥", "5");
        
        $this->assertInstanceOf("\App\Card\Card", $card);
    }

    /**
     * 
     */
    public function testCardToString()
    {
        $card = new Card("5", "♥", "5");
        $res = $card->toString();
        $this->assertIsString($res);
    }


    // **************************************************
    /**
     * 
     */
    public function testCardhandCreateObject()
    {
        $cardhand = new CardHand();
        
        $this->assertInstanceOf("\App\Card\CardHand", $cardhand);
    }

    /**
     * 
     */
    public function testCardhandGetCards()
    {
        $cardhand = new CardHand();
        $res = $cardhand->getCards();
        
        $this->assertIsArray($res);
    }


    // **************************************************

    /**
     * 
     */
    public function testDeckCardsInDeck()
    {
        $deck = new Deck();
        $res = $deck->cardsInDeck();
        
        $this->assertIsNumeric($res);
    }

        // **************************************************

    /**
     * Construct object and verify that the object is of expected instance.
     * Use no arguments.
     */
    public function testCreatePlayerWithNoArguments()
    {
        $player = new Player();
        $this->assertInstanceOf("\App\Card\Player", $player);
    }

    /**
     * 
     */
    public function testPlayerGetCardhand()
    {
        $player = new Player();
        $res = $player->getCardhand();
        $this->assertInstanceOf("\App\Card\CardHand", $res);
    }

    /**
     * 
     */
    public function testGetPoints()
    {
        $player = new Player();
        $res = $player->getPoints();
        $this->assertIsNumeric($res);
    }

    /**
     * 
     */
    public function testResetPoints()
    {
        $player = new Player();
        $res = $player->resetPoints();
        $this->assertEquals($res, 0);
    }

    // ************************************

    /**
     * 
     */
    // public function testGameCreateObject()
    // {
    //     $deck = new Deck();
    //     $player = new Player();
    //     $bank = new Player();
    //     $game = new Game($deck, $player, $bank);
    //     $res = $game->getDeck();
    //     $this->assertInstanceOf("\App\Card\Deck", $res);
    // }

    /**
     * 
     */
    public function testGameGetMessage()
    {
        $deck = new Deck();
        $player = new Player();
        $bank = new Player();
        $game = new Game($deck, $player, $bank);
        $res = $game->getMessage();
        $this->assertIsString($res);
    }


}
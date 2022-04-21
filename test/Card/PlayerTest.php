<?php

namespace App\Card;
use App\Card\Player;
use App\Card\CardHand;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Player.
 */
class PlayerTest extends TestCase
{
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
    public function testCardhandCreateObject()
    {
        $cardhand = new CardHand();
        
        $this->assertInstanceOf("\App\Card\CardHand", $cardhand);
    }

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
    // public function testCardhandAddCard()
    // {
    //     $card = new Card();
    //     $cardhand = new CardHand();
    //     // $cardhand = $player->getCardhand();
        
    //     $this->assertInstanceOf("\App\Card\CardHand", $cardhand);
    // }

    /**
     * Construct object and verify that the object is of expected instance.
     * Use "Dealer".
     */
    // public function testCreateDealer()
    // {
    //     $player = new Player("Dealer");
    //     $this->assertEquals("Dealer", $player->getName());
    //     $this->assertEquals(3, $player->getNoOfDices());
    //     $this->assertEquals(0, $player->getScore());
    // }

    /**
     * Construct object and verify that the object is of expected instance.
     * Use "Player".
     */
    // public function testCreatePlayer()
    // {
    //     $player = new Player("Player");
    //     $this->assertEquals("Player", $player->getName());
    //     $this->assertEquals(3, $player->getNoOfDices());
    //     $this->assertEquals(0, $player->getScore());
    // }

    /**
     * Construct object and verify that the object is of expected instance.
     * Use "Player".
     */
    // public function testCreatePlayerRollAndCheckScore()
    // {
    //     srand(12345);  // To seed random number for shuffle
    //     $player = new Player("Player");
    //     $this->assertEquals(0, $player->getScore());
    //     $score = $player->rollDices();
    //     $player->setScore($score);
    //     $this->assertEquals($score, $player->getScore());
    // }
}
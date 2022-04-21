<?php

namespace App\Card;
use App\Card\Player;
use App\Card\CardHand;
use App\Game\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Deck.
 */
class DeckTest extends TestCase
{
    /**
     * Tests that the cardsInDeck method returns a number, which also is 52
     */
    public function testDeckCardsInDeck()
    {
        $deck = new Deck();
        $res = $deck->cardsInDeck();
        
        $this->assertIsNumeric($res);
        $this->assertEquals($res, 52);
    }

    /**
     * Tests that the draw method returns an array with two elements
     */
    public function testDeckDraw()
    {
        $deck = new Deck();
        $res = $deck->draw();
        
        $this->assertIsArray($res);
        $this->assertSameSize($res, [1, 2]);
    }
}
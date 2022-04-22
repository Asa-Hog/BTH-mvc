<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
 */
class CardTest extends TestCase
{
    /**
     * Tests that created card object is instance of card
     */
    public function testCardCreateObject()
    {
        $card = new Card("5", "♥", "5");

        $this->assertInstanceOf("\App\Card\Card", $card);
    }

    /**
     * Tests that the getDetails method returns an array with three elements
     **/
    public function testCardGetDetails()
    {
        $card = new Card("5", "♥", "5");
        $res = $card->getDetails();

        $this->assertIsArray($res);
        $this->assertSameSize($res, [1, 2, 3]);
    }

    /**
     * Tests that the toString method returns a string
     */
    public function testCardToString()
    {
        $card = new Card("5", "♥", "5");
        $res = $card->toString();

        $this->assertIsString($res);
    }
}

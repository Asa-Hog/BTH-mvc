<?php

namespace App\Card;

use App\Card\CardHand;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class CardHand.
 */
class CardHandTest extends TestCase
{
    /**
     * Tests that a created cardHand is an instance of CardHand
     */
    public function testCardhandCreateObject()
    {
        $cardhand = new CardHand();

        $this->assertInstanceOf("\App\Card\CardHand", $cardhand);
    }

    /**
     * Tests that adding cards with addCard works
     */
    public function testCardhandAddCard()
    {
        $cardhand = new CardHand();
        $card = new Card("5", "♥", "5");

        $resBefore = $cardhand->getCards();
        $this->assertSame($resBefore, []);

        $cardhand->addCard($card);

        $resAfter = $cardhand->getCards();
        $this->assertSameSize($resAfter, [1]);
    }


    /**
     * Tests that method getCards returns an array
     */
    public function testCardhandGetCards()
    {
        $cardhand = new CardHand();
        $res = $cardhand->getCards();

        $this->assertIsArray($res);
    }
}

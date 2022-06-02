<?php

namespace App\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class CardHand.
 */
class DiceHandTest extends TestCase
{
    /**
     * Tests that the method returns an int
     */
    public function testGetNumberDices()
    {
        $dice = new DiceHand();
        $res = $dice->getNumberDices();

        $this->assertIsInt($res);
    }

    // /**
    //  * Tests that the method returns a string
    //  */
    public function testGetAsString()
    {
        $dice = new DiceHand();
        $res = $dice->getAsString();


        $this->assertIsString($res);
    }
}

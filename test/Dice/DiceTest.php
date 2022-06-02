<?php

namespace App\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class CardHand.
 */
class DiceTest extends TestCase
{
    // /**
    //  * Tests that the method returns a string
    //  */
    public function testGetAsString()
    {
        $dice = new Dice();
        $res = $dice->getAsString();


        $this->assertIsString($res);
    }

    /**
     * Tests that the method returns an int
     */
    public function testRoll()
    {
        $dice = new Dice();
        $res = $dice->roll();


        $this->assertIsInt($res);
    }
}

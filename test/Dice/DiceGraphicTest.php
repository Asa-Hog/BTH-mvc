<?php

namespace App\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceGraphic.
 */
class DiceGraphicTest extends TestCase
{
    // /**
    //  * Tests that the method returns a string
    //  */
    public function testGetAsString()
    {
        $dice = new DiceGraphic();
        $res = $dice->getAsString();


        $this->assertIsString($res);
    }
}

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
     * Creates player and gets its cardhand and verifies that it's an instance of CardHand
     */
    public function testPlayerGetCardhand()
    {
        $player = new Player();
        $res = $player->getCardhand();
        $this->assertInstanceOf("\App\Card\CardHand", $res);
    }

    /**
     * Verifies that the getPoints method returns a number
     */
    public function testGetPoints()
    {
        $player = new Player();
        $res = $player->getPoints();
        $this->assertIsNumeric($res);
    }

    /**
     * Verifies that the resetPoints method sets points to 0
     */
    public function testResetPoints()
    {
        $player = new Player();
        $res = $player->resetPoints();
        $this->assertEquals($res, 0);
    }
}

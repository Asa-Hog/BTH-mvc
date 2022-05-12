<?php

namespace App\Card;

use App\Card\Player;
use App\Card\CardHand;
use App\Game\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game.
 */
class GameTest extends TestCase
{
    /**
     * Verifies that a created game object is an instance of Game
     */
    public function testGameCreateObject()
    {
        $deck = new Deck();
        $player = new Player();
        $bank = new Player();
        $game = new Game($deck, $player, $bank);

        $this->assertInstanceOf("\App\Game\Game", $game);
    }

    /**
     * Verifies that the getDeck method returns an instance of Deck
     */
    public function testGameGetDeck()
    {
        $deck = new Deck();
        $player = new Player();
        $bank = new Player();
        $game = new Game($deck, $player, $bank);

        $res = $game->getDeck();
        $this->assertInstanceOf("\App\Card\Deck", $res);
    }

    /**
     * Verifies that the getMessage method returns a string
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

    // /**
    //  * Verifies that the getMessage method returns a string
    //  */
    // public function testGameGetMessage()
    // {
    //     $deck = new Deck();
    //     $player = new Player();
    //     $bank = new Player();
    //     $game = new Game($deck, $player, $bank);

    //     $res = $game->getMessage();
    //     $this->assertIsString($res);
    // }

    /**
     * Verifies that the setWinner method sets a string
     */
    public function testGameSetWinner()
    {
        $deck = new Deck();
        $player = new Player();
        $bank = new Player();
        $game = new Game($deck, $player, $bank);

        $resBefore = $game->getWinner();
        $this->assertEquals($resBefore, "");

        $game->setWinner("exists");

        $resAfter = $game->getWinner();
        $this->assertEquals($resAfter, "exists");
    }

    /**
     * Verifies that the checkPointsOver21 resets points to 0
     */
    public function testCheckPointsOver21()
    {
        $deck = new Deck();
        $player = new Player();
        $bank = new Player();
        $game = new Game($deck, $player, $bank);

        $player->setPoints(19);
        $bank->setPoints(22);

        $game->checkPointsOver21();
        $res = $game->getMessage();

        $this->assertEquals($res, "The winner is the player!");
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

use App\Card\Player;
use App\Card\CardHand;
use App\Card\Deck;
use App\Game\Game;

// use App\Card\Player;

class GameController extends AbstractController
{
    /**
     * @Route("/game/start", name="game-start")
     */
    public function start(SessionInterface $session): Response
    {
        // $session->set("game", null); //
        // Rensa allt i sessionen
        $session->clear();

        $player = new Player();
        $cardHand = new CardHand();
        $player->addCardHand($cardHand);

        $bank = new Player();
        $cardHandBank = new CardHand();
        $bank->addCardHand($cardHandBank);

        $deck = new Deck();
        // $game = new \App\Game\Game($deck, $player, $bank);
        $game = $session->get("game") ?? new Game($deck, $player, $bank);

        // $game->setWinner(null); // Nollställer vinnare // Behövs inte för sessionen är nollställd
        // $game->set_message(""); // Nollställer vinnare
        // $game->get_player()->reset_cardhand();

        $game->start();

        $session->set("game", $game);

        $data = [
            'game' => $game
        ];

        return $this->render('game/start.html.twig', $data);
    }

    /**
     * @Route("/game/draw", name="game-draw")
     */
    public function draw(SessionInterface $session): Response
    {
        // $game = $session->get("game") ?? new \App\Card\Deck();
        $game = $session->get("game");
        $drawnCard = $game->getDeck()->draw()[0];
        $game->getPlayer()->getCardhand()->addCard($drawnCard);
        $value = (int) $drawnCard->getDetails()[2];

        $game->getPlayer()->setPoints($value);
        $session->set("game", $game);

        $data = [
            'game' => $game
        ];

        return $this->render('game/start.html.twig', $data);
    }

    /**
     * @Route("/game/stop", name="game-stop")
     */
    public function stop(SessionInterface $session): Response
    {
        $game = $session->get("game");
        // Let the bank draw
        while ((int) $game->getBank()->getPoints() < 17) {
            $drawnCard = $game->getDeck()->draw()[0];
            $game->getBank()->getCardhand()->addCard($drawnCard);
            $value = (int) $drawnCard->getDetails()[2];
            $game->getBank()->setPoints($value);
        }

        $game->setWinner("exists");

        $session->set("game", $game);

        $data = [
            'game' => $game
        ];

        return $this->render('game/start.html.twig', $data);
    }
}

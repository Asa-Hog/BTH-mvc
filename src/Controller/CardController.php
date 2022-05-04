<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Card\Deck;
use App\Card\Player;
use App\Card\CardHand;
use App\Card\Deck2;

class CardController extends AbstractController
{
    /**
     * @Route("card/deck", name="card-deck")
     */
    public function deck(): Response
    {
        $deck = new Deck(); // Skapa nytt deck-objekt
        $data = [
            'title' => 'Deck',
            'get_cards' => $deck->getCards()
        ];

        return $this->render('card/deck.html.twig', $data);
    }

    /**
     * @Route("shuffle", name="card-shuffle")
     */
    public function shuffle(SessionInterface $session): Response
    {
        $deck = new Deck(); // Skapa nytt deck-objekt

        // Nollställer kortleken
        $session->set("deck", $deck);
        $session->set("removedCardsTotal", []);

        $data = [
            'title' => 'Shuffle',
            'get_cards' => $deck->getShuffledCards()
        ];


        return $this->render('card/shuffle.html.twig', $data);
    }

    /**
     * @Route("/draw", name="card-draw")
     */
    public function draw(
        SessionInterface $session
    ): Response {
        // Hämta kortleken från sessionen eller skapa nytt deck-objekt
        $deck = $session->get("deck") ?? new Deck();

        $data = [
            'title' => 'Draw',
            'card_data' => $deck->draw()
        ];

        $session->set("deck", $deck);

        return $this->render('card/draw.html.twig', $data);
    }

    /**
     * @Route("/draw-number", name="card-draw-number",
     * methods={"GET", "POST"})
     */
    public function drawNumber(Request $request, SessionInterface $session): Response
    {
        // Hämta kortleken från sessionen eller skapa nytt deck-objekt
        $deck = $session->get("deck") ?? new Deck();
        // Hämta alla kort som blivit dragna hittills
        $removedCardsTotal = $session->get("removedCardsTotal") ?? [];

        $data = [
            'number' => $request->query->get('number'),
            'cardsLeft' => $deck->cardsInDeck(),
        ];

        $removedCardsSet = [];
        if ($data["cardsLeft"] >= $data["number"]) {
            for ($i = 0; $i < $data["number"]; $i++) {
                $drawn = $deck->draw();// korten tas bort från kortleken här
                array_push($removedCardsSet, $drawn); // Borttagna kort läggs här
            }
        }

        $data['cardsLeft'] = $deck->cardsInDeck();
        $data['cards'] = $deck->getCards(); // Detta är korten som är kvar
        $data['removedCardsSet'] = $removedCardsSet; // Detta är borttagna kort

        $removedCardsTotal = $removedCardsTotal + $removedCardsSet; // Lägger till nya kort
        // som dragits
        $session->set("deck", $deck);
        $session->set("removedCardsTotal", $removedCardsTotal);

        return $this->render('card/drawNumber.html.twig', $data);
    }

    // /deal/{players}/{cards}
    /**
     * @Route("/deal", name="card-deal",
     * methods={"GET", "POST"}))
     */
    public function deal(
        Request $request,
        SessionInterface $session
    ): Response {
        $deck = $session->get("deck") ?? new Deck();
        $removedCardsTotal = $session->get("removedCardsTotal") ?? [];

        $data = [
            'title' => 'Deal',
            'players' => $request->query->get('players'),
            'cards' => $request->query->get('cards'),
            'cardsLeft' => $deck->cardsInDeck()
        ];

        $removedCardsSet = []; // de som försvinner från kortleken
        $playersArray = [];
        if ($data["cardsLeft"] >= $data["cards"] * $data["players"]) {
            for ($i = 0; $i < $data["players"]; $i++) {
                $player = new Player(); //skapa spelare
                $cardhand = new CardHand(); //skapa korthand
                $player->addCardhand($cardhand);
                array_push($playersArray, $player);

                for ($j = 0; $j < $data["cards"]; $j++) {
                    $drawn = $deck->draw();// ta bort kort från kortleken
                    $cardhand->addCard($drawn[0]); // lägger det till spelarens hand
                    array_push($removedCardsSet, $drawn); // lägg kortet här
                }
            }
        }

        $data['cardsLeft'] = $deck->cardsInDeck();
        $data['removedCardsSet'] = $removedCardsSet; //  borttagna kort
        $data['playersArray'] = $playersArray;
        $data['noOfPlayers'] = count($playersArray);


        $removedCardsTotal = $removedCardsTotal + $removedCardsSet;
        $session->set("deck", $deck);
        $session->set("removedCardsTotal", $removedCardsTotal);

        return $this->render('card/deal.html.twig', $data);
    }

    /**
     * @Route("/deck2", name="card-deck2")
     */
    public function deck2(): Response
    {
        $deck2 = new Deck2(); // Skapa nytt deck2-objekt
        $data = [
            'title' => 'Deck2',
            'get_cards' => $deck2->getCards()
        ];

        return $this->render('card/deck2.html.twig', $data);
    }

    /**
     * @Route("/game-card", name="card-game-card")
     */
    public function gameCard(): Response
    {
        $data = [
            'title' => 'Game card'
        ];

        return $this->render('card/gameCard.html.twig', $data);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Card;

class JsonController extends AbstractController
{
    /**
     * @Route("/api/deck", name="json-deck",
     * methods={"GET","POST"})
     */
    public function jsonDeck(): Response
    {
        $cardArray = [];
        $deck = new \App\Card\Deck();
        $cards = $deck->get_cards(); // array med objekt

        for ($i = 0; $i < count($cards); $i++) {
            array_push($cardArray, $cards[$i]->to_string());
            // array med strängar
        }

        $data = [
            'title' => 'Json deck',
            'get_cards' => $cardArray
        ];

        return new JsonResponse($data);
    }
}

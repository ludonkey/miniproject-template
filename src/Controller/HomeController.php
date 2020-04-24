<?php

namespace Controller;

use Entity\Card;
use framework\Http\Request;
use framework\Http\Response;
use framework\Controller\AbstractController;

class HomeController extends AbstractController
{

    public function display(Request $request): Response
    {
        $cardRepository = $this->getOrm()->getRepository(Card::class);
        $cards = $cardRepository->findAll();
        $data = array(
            "myText" => "Hello everybody !",
            "cards" => $cards
        );

        return $this->render('home/main.php', $data);
    }

    public function search(Request $request): Response
    {
        $search = $request->query["search"];
        $cardRepository = $this->getOrm()->getRepository(Card::class);
        $cards = $cardRepository->findBy(array("text" => $search));
        $data = array(
            "myText" => "Search Results ...",
            "cards" => $cards
        );

        return $this->render('home/main.php', $data);
    }
}
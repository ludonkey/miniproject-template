<?php

namespace Controller;

use Entity\Card;
use Entity\Image;
use ludk\Http\Request;
use ludk\Http\Response;
use ludk\Controller\AbstractController;

class HomeController extends AbstractController
{

    public function display(Request $request): Response
    {
        $cardRepository = $this->getOrm()->getRepository(Card::class);

        $cards = array();
        $text = "Hello everybody !";

        if ($request->query->has('search')) {
            $text = "Search Results ...";
            $strToSearch = $request->query->get('search');
            $cards = $cardRepository->findBy(array("content" => "%$strToSearch%"));
        } else {
            $cards = $cardRepository->findAll();
        }

        $data = array(
            "myText" => $text,
            "cards" => $cards
        );

        return $this->render('home/main.php', $data);
    }

    public function reset(Request $request): Response
    {
        $this->getOrm()->reset();
        return $this->redirectToRoute('homepage');
    }
}

<?php

namespace Controller;

use framework\Http\Request;
use framework\Http\Response;
use Repository\CardRepository;
use framework\Controller\AbstractController;

class HomeController extends AbstractController
{

    public function display(Request $request): Response
    {
        $cardRepository = new CardRepository();
        $cards = $cardRepository->findAll();
        $data = array(
            "myText" => "Hello everybody !",
            "cards" => $cards
        );

        return $this->render('home/main.php', $data);
    }
}

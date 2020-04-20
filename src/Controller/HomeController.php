<?php

namespace Controller;

use framework\Entity\Request;
use framework\Entity\Response;
use framework\Controller\AbstractController;

class HomeController extends AbstractController
{

    public function display(Request $request): Response
    {
        $data = array(
            "myText" => "Hello everybody !"
        );
        return $this->render('home/main.php', $data);
    }
}

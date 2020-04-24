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
        $manager = $this->getOrm()->getManager();
        $cardRepository = $this->getOrm()->getRepository(Card::class);
        $imgRepository = $this->getOrm()->getRepository(Image::class);

        $newImage = new Image();
        $newImage->url = 'https://cdn.pixabay.com/photo/2015/10/22/17/45/leaf-1001679_960_720.jpg';
        $newCard = new Card();
        $newCard->title = "Green Leeves";
        $newCard->text = "Free for commercial use.";
        $newCard->image = $newImage;
        $manager->persist($newCard);

        $cardToDelete = $cardRepository->find(3);
        $manager->remove($cardToDelete);

        $cardToUpdateTitle = $cardRepository->find(1);
        $cardToUpdateTitle->title = "new title";
        $manager->persist($cardToUpdateTitle);

        $cardToUpdateImg = $cardRepository->find(4);
        $cardToUpdateImg->image->url = "https://cdn.pixabay.com/photo/2020/04/22/06/47/hydrangea-5076212_960_720.jpg";
        $manager->persist($cardToUpdateImg);

        $imgToUpdate = $imgRepository->find(2);
        $imgToUpdate->url = "https://cdn.pixabay.com/photo/2016/11/01/13/54/europe-1788319_960_720.jpg";
        $manager->persist($imgToUpdate);

        $manager->flush();

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
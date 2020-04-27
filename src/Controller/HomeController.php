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
        $cards = $cardRepository->findAll();
        $data = array(
            "myText" => "Hello everybody !",
            "cards" => $cards
        );

        return $this->render('home/main.php', $data);
    }

    public function reset(Request $request): Response
    {
        $this->getOrm()->reset();
        return $this->redirectToRoute('homepage');
    }

    public function remove(Request $request): Response
    {
        $manager = $this->getOrm()->getManager();
        $cardRepository = $this->getOrm()->getRepository(Card::class);
        $cardToDelete = $cardRepository->find($request->query->get('id'));
        if (!empty($cardToDelete)) {
            $manager->remove($cardToDelete);
            $manager->flush();
        }
        return $this->redirectToRoute('homepage');
    }

    public function create(Request $request): Response
    {
        $manager = $this->getOrm()->getManager();
        $newImage = new Image();
        $newImage->url = $request->query->get('url', '');
        $newCard = new Card();
        $newCard->title = $request->query->get('title', 'empty title');
        $newCard->text = $request->query->get('text', 'empty text');
        $newCard->image = $newImage;

        $manager->persist($newCard);
        $manager->flush();
        return $this->redirectToRoute('homepage');
    }

    public function update(Request $request): Response
    {
        $manager = $this->getOrm()->getManager();
        $cardRepository = $this->getOrm()->getRepository(Card::class);
        $cardToUpdate = $cardRepository->find($request->query->get('id'));

        $cardToUpdate->title = $request->query->get('title', $cardToUpdate->title);
        $cardToUpdate->text = $request->query->get('text', $cardToUpdate->text);
        $cardToUpdate->image->url = $request->query->get('url', $cardToUpdate->image->url);

        $manager->persist($cardToUpdate);
        $manager->flush();
        return $this->redirectToRoute('homepage');
    }

    public function search(Request $request): Response
    {
        $search = $request->query->get('search');
        $cardRepository = $this->getOrm()->getRepository(Card::class);
        $cards = $cardRepository->findBy(array("text" => $search));
        $data = array(
            "myText" => "Search Results ...",
            "cards" => $cards
        );
        return $this->render('home/main.php', $data);
    }
}

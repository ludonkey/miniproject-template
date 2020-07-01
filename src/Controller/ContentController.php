<?php

namespace Controller;

use Entity\Card;
use Entity\Image;
use ludk\Http\Request;
use ludk\Http\Response;
use ludk\Controller\AbstractController;

class ContentController extends AbstractController
{

    public function create(Request $request): Response
    {
        if (!$request->getSession()->has('user')) {
            return $this->redirectToRoute('homepage');
        }

        $data = [
            "title" => $request->request->get('title', ''),
            "description" => $request->request->get('description', ''),
            "image_url" => $request->request->get('image_url', ''),
            "external_url" => $request->request->get('external_url', '')
        ];

        if (
            !$request->request->has('title') ||
            !$request->request->has('description') ||
            !$request->request->has('image_url') ||
            !$request->request->has('external_url')
        ) {
            return $this->render('content/new.php', $data);
        }

        $errorMsg = NULL;
        if (empty($request->request->get('title'))) {
            $errorMsg = "Put a title.";
        } else if (empty($request->request->get('description'))) {
            $errorMsg = "Put a description.";
        } else if (empty($request->request->get('image_url'))) {
            $errorMsg = "Put an image URL.";
        } else if (empty($request->request->get('external_url'))) {
            $errorMsg = "Put an external Link.";
        }
        if ($errorMsg) {
            $data["errorMsg"] = $errorMsg;
            return $this->render('content/new.php', $data);
        } else {
            $newImage = new Image();
            $newImage->url = $request->request->get('image_url');
            $newCard = new Card();
            $newCard->user = $request->getSession()->get('user');
            $newCard->title = $request->request->get('title');
            $newCard->text = $request->request->get('description');
            $newCard->link = $request->request->get('external_url');
            $newCard->image = $newImage;
            $manager = $this->getOrm()->getManager();
            $manager->persist($newCard);
            $manager->flush();
            return $this->redirectToRoute('homepage');
        }
    }

    public function remove(Request $request): Response
    {
        if (!$request->getSession()->has('user')) {
            return $this->redirectToRoute('homepage');
        }

        $manager = $this->getOrm()->getManager();
        $cardRepository = $this->getOrm()->getRepository(Card::class);
        $cardToDelete = $cardRepository->find($request->query->get('id'));
        if (
            !empty($cardToDelete) &&
            $cardToDelete->user->id == $request->getSession()->get('user')->id
        ) {
            $manager->remove($cardToDelete);
            $manager->flush();
        }
        return $this->redirectToRoute('homepage');
    }
}

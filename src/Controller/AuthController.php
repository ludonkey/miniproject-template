<?php

namespace Controller;

use Entity\User;
use ludk\Http\Request;
use ludk\Http\Response;
use ludk\Controller\AbstractController;

class AuthController extends AbstractController
{
    public function login(Request $request): Response
    {
        $userRepo = $this->getOrm()->getRepository(User::class);

        if (
            $request->request->has('username') &&
            $request->request->has('password')
        ) {
            $users = $userRepo->findBy(
                array(
                    "nickname" => $request->request->get('username'),
                    "password" => $request->request->get('password')
                )
            );
            if (count($users) == 1) {
                $request->getSession()->set('user', $users[0]);
                return $this->redirectToRoute('homepage');
            } else {
                $data = array(
                    "errorMsg" => "Wrong login and/or password."
                );
                return $this->render('auth/login.php', $data);
            }
        } else {
            return $this->render('auth/login.php');
        }
    }

    public function logout(Request $request): Response
    {
        if ($request->getSession()->has('user')) {
            $request->getSession()->remove('user');
        }
        return $this->redirectToRoute('homepage');
    }

    public function register(Request $request): Response
    {
        $userRepo = $this->getOrm()->getRepository(User::class);
        $manager = $this->getOrm()->getManager();

        if (
            $request->request->has('username') &&
            $request->request->has('password') &&
            $request->request->has('passwordRetype')
        ) {
            $errorMsg = NULL;
            $users = $userRepo->findBy(array("nickname" => $request->request->get('username')));
            if (count($users) > 0) {
                $errorMsg = "Nickname already used.";
            } else if ($request->request->get('password') != $request->request->get('passwordRetype')) {
                $errorMsg = "Passwords are not the same.";
            } else if (strlen(trim($request->request->get('password'))) < 8) {
                $errorMsg = "Your password should have at least 8 characters.";
            } else if (strlen(trim($request->request->get('username'))) < 4) {
                $errorMsg = "Your nickame should have at least 4 characters.";
            }
            if ($errorMsg) {
                $data = array(
                    "errorMsg" => $errorMsg
                );
                return $this->render('auth/register.php', $data);
            } else {
                $newUser = new User();
                $newUser->nickname = $request->request->get('username');
                $newUser->password = $request->request->get('password');
                $manager->persist($newUser);
                $manager->flush();
                $request->getSession()->set('user', $newUser);
                return $this->redirectToRoute('homepage');
            }
        } else {
            return $this->render('auth/register.php');
        }
    }
}

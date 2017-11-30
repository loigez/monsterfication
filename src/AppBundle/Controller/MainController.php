<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $user = $this->get('user.service');

        $userId = (int)$request->get('id', 1);

        $userData = $user->getById($userId);
        $allProgressBadges = $userData->getAllProgressBadges();

        return $this->render('default/index.html.twig',
            [
                'user' => $userData,
                'allBadgesWithProgress' => $allProgressBadges
            ]);
    }
}

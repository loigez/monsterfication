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

        $userService = $this->get('user.service');
        $userId = $this->getUser()->getId();

        $userData = $userService->getById($userId);
        $allProgressBadges = $userData->getAllProgressBadges();

        return $this->render('default/index.html.twig',
            [
                'allBadgesWithProgress' => $allProgressBadges
                //'activityProgress' => $allProgressBadges
                //'topTen' => $allProgressBadges
            ]);
    }
}

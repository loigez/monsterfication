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

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig',
            [
                'user' => $user->getById($userId)
            ]);
    }
}

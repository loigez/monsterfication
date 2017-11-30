<?php

namespace AppBundle\Controller\Panel;

use AppBundle\DomainModel\BadgeService;
use AppBundle\DomainModel\UserService;
use AppBundle\Entity\Badge;
use AppBundle\Form\BadgeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/panel/user/", name="admin_panel_user_index")
     */
    public function indexAction(Request $request)
    {

        /** @var UserService $badgeService */
        $userService = $this->get('user.service');

        return $this->render('panel/user/index.html.twig', [
            'users' => $userService->findAll(),
        ]);

    }
}

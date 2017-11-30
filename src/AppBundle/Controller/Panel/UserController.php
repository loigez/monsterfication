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


    /**
     * @Route("/panel/user/assign", name="admin_panel_user_assign_badge")
     */
    public function assignBadgeToUserAction(Request $request)
    {
//        /** @var BadgeService $badgeService */
//        $badgeService = $this->get('badge.service');
//
//
//        $badge = new Badge();
//        $form = $this->createForm(BadgeType::class, $badge);
//        $form->add('submit', SubmitType::class, array(
//            'label' => 'Create badge',
//        ));

        return $this->render('panel/user/assign_badge.html.twig',[
        ]);
//        return $this->render('panel/add_badge.html.twig', [
//            //'badge_form' => $form->createView()
//        ]);
    }
}

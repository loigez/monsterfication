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

class UserBadgeController extends Controller
{
    /**
     * @Route("/panel/user/badge", name="admin_panel_user_badge_index")
     */
    public function indexAction(Request $request)
    {

        /** @var BadgeService $badgeService */
        $badgeService = $this->get('badge.service');
//$userid
        return $this->render('panel/userbadge/index.html.twig', [
            'badges' => $badgeService->findAll(),
        ]);

    }

    public function assignAction(Request $request)
    {die('eee');
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

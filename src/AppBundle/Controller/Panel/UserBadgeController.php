<?php

namespace AppBundle\Controller\Panel;

use AppBundle\DomainModel\BadgeService;
use AppBundle\DomainModel\UserBadgeProgressService;
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

        return $this->render('panel/userbadge/index.html.twig', [
            'badges' => $badgeService->findAll(),
            'user_id' => (int)$request->get('userId', null)
        ]);

    }

    /**
     * @Route("/panel/user/{userId}/badge/{badgeId}/activate", name="admin_panel_user_badge_activate")
     */
    public function activateAction(Request $request)
    {

        /** @var BadgeService $badgeService */
        $badgeService = $this->get('badge.service');
        $badge = $badgeService->find((int)$request->get('badgeId'));

        /** @var UserService $userService */
        $userService = $this->get('user.service');
        $user = $userService->find((int)$request->get('userId'));

        /** @var UserBadgeProgressService $userBadgeProgressService */
        $userBadgeProgressService = $this->get('user_badge_progress.service');
        $userBadgeProgressService->activateUsersBadge($user, $badge);

        return $this->redirectToRoute('admin_panel_user_badge_index', ['userId' => (int)$request->get('userId')]);

    }
}

<?php

namespace AppBundle\Controller\Panel;

use AppBundle\DomainModel\BadgeService;
use AppBundle\DomainModel\UserBadgeProgressService;
use AppBundle\DomainModel\UserService;
use AppBundle\Entity\Badge;
use AppBundle\Entity\UserBadgeProgress;
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
        $userService = $this->get('user.service');
        $userData = $userService->getById((int)$request->get('userId', null));

        return $this->render('panel/UserBadge/index.html.twig', [
            'allBadgesWithProgress' => $userData->getAllProgressBadges(),
            'user_id' => (int)$request->get('userId', null)
        ]);

    }

    /**
     * @Route("/panel/user/badge/unactivate/{id}", name="admin_panel_user_badge_unactivate")
     */
    public function unactivateAction(Request $request)
    {
        /** @var UserBadgeProgressService $userBadgeProgressService */
        $userBadgeProgressService = $this->get('user_badge_progress.service');
        $userBadgeProgressService->unActivateUsersBadge((int)$request->get('id'));
        $progress = $userBadgeProgressService->getById((int)$request->get('id'));

        return $this->redirectToRoute('admin_panel_user_badge_index', ['userId' => $progress->getUser()->getId()]);
    }


        /**
     * @Route("/panel/user/badge/activate/{id}", name="admin_panel_user_badge_activate")
     */
    public function activateAction(Request $request)
    {
        /** @var UserBadgeProgressService $userBadgeProgressService */
        $userBadgeProgressService = $this->get('user_badge_progress.service');
        $userBadgeProgressService->activateUsersBadge((int)$request->get('id'));
        $progress = $userBadgeProgressService->getById((int)$request->get('id'));

        return $this->redirectToRoute('admin_panel_user_badge_index', ['userId' => $progress->getUser()->getId()]);

    }
}

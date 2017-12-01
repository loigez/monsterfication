<?php

namespace AppBundle\Controller\Panel;

use AppBundle\DomainModel\BadgeService;
use AppBundle\DomainModel\UserBadgeProgressService;
use AppBundle\DomainModel\UserService;
use AppBundle\Entity\Badge;
use AppBundle\Form\BadgeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class BadgeController extends Controller
{
    /**
     * @Route("/panel/badge/", name="admin_panel_badge_index")
     */
    public function indexAction(Request $request)
    {
        /** @var BadgeService $badgeService */
        $badgeService = $this->get('badge.service');

        return $this->render('panel/Badge/index.html.twig', [
            'badges' => $badgeService->findAll(),
        ]);

    }

    /**
     * @Route("/panel/badge/add", name="admin_panel_badge_add")
     */
    public function addBadgeAction(Request $request)
    {
        /** @var BadgeService $badgeService */
        $badgeService = $this->get('badge.service');

        $badge = new Badge();
        $form = $this->createForm(BadgeType::class, $badge);
        $form->add('submit', SubmitType::class, array(
            'label' => 'Create badge',
        ));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Badge $badge */
            $badgeService->save($form->getData());

            /** @var UserService $badgeService */
            $userService = $this->get('user.service');
            $users = $userService->findAll();


            /** @var UserBadgeProgressService $userBadgeProgressService */
            $userBadgeProgressService = $this->get('user_badge_progress.service');
            $userBadgeProgressService->assignBadgeToUsers($users, $badge);


            return $this->redirectToRoute('admin_panel_badge_index');
        }

        return $this->render('panel/Badge/add_badge.html.twig', [
            'badge_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/panel/badge/delete/{id}", name="admin_panel_badge_delete")
     */
    public function deleteBadgeAction(Request $request)
    {
        /** @var BadgeService $badgeService */
        $badgeService = $this->get('badge.service');
        $badge = $badgeService->find((int)$request->get('id', null));

        /** @var UserBadgeProgressService $userBadgeProgressService */
        $userBadgeProgressService = $this->get('user_badge_progress.service');
        $userBadgeProgress = $userBadgeProgressService->getByBadge($badge);

        $userBadgeProgressService->unasigneBadgeFromUsers($userBadgeProgress);
        $badgeService->delete($badge);

        return $this->redirectToRoute('admin_panel_badge_index');

    }

    /**
     * @Route("/panel/badge/edit/{id}", name="admin_panel_badge_edit")
     */
    public function editBadgeAction(Request $request)
    {
        /** @var BadgeService $badgeService */
        $badgeService = $this->get('badge.service');

        $badge = $badgeService->find((int)$request->get('id', null));
        $form = $this->createForm(BadgeType::class, $badge);
        $form->add('submit', SubmitType::class, array(
            'label' => 'Edit badge',
        ));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Badge $badge */
            $badgeService->save($form->getData());

            return $this->redirectToRoute('admin_panel_badge_index');
        }

        return $this->render('panel/Badge/add_badge.html.twig', [
            'badge_form' => $form->createView(),
        ]);
    }
}

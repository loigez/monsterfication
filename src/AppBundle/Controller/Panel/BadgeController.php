<?php

namespace AppBundle\Controller\Panel;

use AppBundle\DomainModel\BadgeService;
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

        return $this->render('panel/badge/index.html.twig', [
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
            return $this->redirectToRoute('admin_panel_index');
        }

        return $this->render('panel/badge/add_badge.html.twig', [
            'badge_form' => $form->createView(),
        ]);
    }
}

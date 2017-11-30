<?php

namespace AppBundle\Controller\Panel;

use AppBundle\DomainModel\BadgeService;
use AppBundle\Entity\Badge;
use AppBundle\Form\BadgeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class PanelController extends Controller
{
    /**
     * @Route("/panel/", name="admin_panel_index")
     */
    public function indexAction(Request $request)
    {
        /** @var BadgeService $badgeService */
        $badgeService = $this->get('badge.service');

        return $this->render('panel/index.html.twig', [
            'badges' => $badgeService->findAll()
        ]);

    }

    /**
     * @Route("/panel/badge/", name="admin_panel_badge_add")
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
            $badgeService->save($form->getData());
            //return $this->redirectToRoute('task_success');
        }

        return $this->render('panel/add_badge.html.twig', [
            'badge_form' => $form->createView()
        ]);
    }

    /**
     * @Route("/panel/user/", name="admin_panel_user_assign_badge")
     */
    public function assignBadgeAction(Request $request)
    {
        $badge = new Badge();
        $form = $this->createForm(BadgeType::class, $badge);
        $form->add('submit', SubmitType::class, array(
            'label' => 'Create badge',
        ));

        return $this->render('panel/add_badge.html.twig', [
            'badge_form' => $form->createView()
        ]);
    }
}

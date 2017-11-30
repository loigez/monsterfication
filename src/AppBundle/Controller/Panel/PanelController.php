<?php

namespace AppBundle\Controller\Panel;

use AppBundle\Entity\Badge;
use AppBundle\Entity\Monsters;
use AppBundle\Form\BadgeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class PanelController extends Controller
{
    /**
     * @Route("/panel/", name="admin_panel")
     */
    public function indexAction(Request $request)
    {
        $badge = new Badge();
        $form = $this->createForm(BadgeType::class, $badge);
        $form->add('submit', SubmitType::class, array(
            'label' => 'Create badge',
        ));

        return $this->render('panel/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'badge_form' => $form->createView()
        ]);
    }
}

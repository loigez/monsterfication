<?php

namespace AppBundle\Controller\Panel;

use AppBundle\Entity\Monsters;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PanelController extends Controller
{
    /**
     * @Route("/panel/", name="admin_panel")
     */
    public function indexAction(Request $request)
    {
        $monsters = $this->getDoctrine()
            ->getRepository(Monsters::class)
            ->findAllOrderedByName();

        var_dump($monsters);

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}

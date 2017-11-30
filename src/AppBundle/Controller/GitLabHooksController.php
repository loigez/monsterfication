<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Monsters;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GitLabHooksController extends Controller
{
    /**
     * @Route("/api/git/", name="api_git")
     */
    public function indexAction(Request $request)
    {

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}

<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GitLabHooksController extends Controller
{
    /**
     * @Route("/api/git/", name="api_git")
     */
    public function indexAction(Request $request)
    {
        $gitlabToken = $this->getParameter('gitlab_token');
        $clientToken = $request->headers->get('X-Gitlab-Token');
        if ($gitlabToken !== $clientToken) {
            return $this->json('Not authorized', Response::HTTP_UNAUTHORIZED);
        }

//        $gitlabService = $this->get('');

        return $this->json('OK');
    }
}

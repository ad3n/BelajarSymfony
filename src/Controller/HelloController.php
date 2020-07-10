<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    /**
     * @Route("/hello", name="app_hello")
     */
    public function index(Request $request): Response
    {
        if ($request->isXmlHttpRequest()) {
            new JsonResponse(['message' => $this->renderView('hello.html.twig', ['name' => 'Surya'])]);
        }

        return $this->render('hello.html.twig', ['name' => 'Surya']);
    }

    /**
     * @Route("/hello-forward")
     */
    public function helloForward(): Response
    {
        return $this->forward(sprintf('%s::index', get_class($this)));
    }
}

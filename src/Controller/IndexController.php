<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/index', methods: ['POST'], name: 'index_index')]
    public function index(): Response
    {
        return $this->json([
            'controller_name' => 'IndexController',
            'a' => 10,
        ]);
    }

    #[Route('/hello/{name}', name: 'index_hello')]
    public function hello($name): Response
    {
        return new Response($this->renderView('hello/index.html.twig', [
            'a' => $name,
        ]));
    }

    #[Route('/binhphuong', name: 'index_binhphuong')]
    public function req(Request $req): Response
    {
        $a = $req->query->get('a');
        $at2 = $a * $a;
        return new Response( $this->renderView('test/index.html.twig', [
            'a' => $at2,
        ]));
    }

   
}

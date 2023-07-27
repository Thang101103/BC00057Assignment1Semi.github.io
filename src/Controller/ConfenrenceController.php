<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConfenrenceController extends AbstractController
{
    #[Route('/confenrence', name: 'app_confenrence')]
    public function index(): Response
    {
        return $this->render('confenrence/index.html.twig', [
            'controller_name' => 'ConfenrenceController',
        ]);
    }
}

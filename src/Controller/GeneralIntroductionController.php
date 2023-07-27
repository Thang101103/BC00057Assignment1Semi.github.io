<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GeneralIntroductionController extends AbstractController
{
    #[Route('/general/introduction', name: 'app_general_introduction')]
    public function index(): Response
    {
        return $this->render('general_introduction/index.html.twig', [
            'controller_name' => 'GeneralIntroductionController',
        ]);
    }
}

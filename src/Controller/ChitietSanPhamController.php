<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChitietSanPhamController extends AbstractController
{
    #[Route('/chitiet/san/pham', name: 'app_chitiet_san_pham')]
    public function index(): Response
    {
        return $this->render('chitiet_san_pham/index.html.twig', [
            'controller_name' => 'ChitietSanPhamController',
        ]);
    }
}

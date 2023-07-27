<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/home_sp', name: 'app_home')]
    public function Home_sp(EntityManagerInterface $em, Request $req): Response
    {
        $query = $em->createQuery('SELECT sp FROM App\Entity\SanPham sp');
        $lSp = $query->getResult();
        $message = $req->query->get('message');
        return $this->render('home/list.html.twig', [
            "data"=>$lSp,
            "message"=>$message
        ]);
    }
}


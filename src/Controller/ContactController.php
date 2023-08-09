<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class ContactController extends AbstractController
{
    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {     
    }
    #[Route('/contact', name: 'app_contact')]
    public function contact(EntityManagerInterface $em,Request $req, FileUploader $fileUploader): Response
    {
        $ct = new Contact();
        $form = $this->createForm(ContactType::class, $ct);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $em->persist($ct);
            $em->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('homepage');
        }
        return $this->render('contact/index.html.twig', [
            'contact_form' => $form->createView(),
        ]);
    }
}

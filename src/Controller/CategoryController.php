<?php

namespace App\Controller;



use App\Entity\Category;
use App\Form\CateFormType;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class CategoryController extends AbstractController
{
    public function __construct(private UrlGeneratorInterface $url)
    {      
    }
    #[Route('/category/ad', name: 'app_category_ad')]
    public function index(EntityManagerInterface $em,Request $req, FileUploader $fileUploader): Response
    {
        $cg = new Category();
        $form = $this->createForm(CateFormType::class, $cg);
        $form -> handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $file = $form->get("photo")->getData();
            $fileName = $fileUploader->upload($file);
            $data -> setPhoto($fileName);
            $em-> persist($data);
            $em->flush();
            return new RedirectResponse($this->url->generate('app_ds_category'));
        }
        return $this->render('category/index.html.twig', [
            'category_form' => $form->createView(),
        ]);
    }
    #[Route('/category/ds', name: 'app_ds_category')]
    public function list_cat(EntityManagerInterface $em): Response
    {
        $query = $em->createQuery('SELECT cg FROM App\Entity\Category cg');
        $lSp = $query->getResult();
        return $this->render('category/list.html.twig', [
            'cg' => $lSp
        ]);

    }
    #[Route('/category/mg/{id}', name: 'app_edit_category')]
    public function edit(EntityManagerInterface $em, int $id,Request $req,FileUploader $fileUploader): Response
    {
        $cg = $em->find(Category::class, $id);
        $form = $this->createForm(CateFormType::class, $cg);
        $form -> handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $file = $form-> get("photo")->getData();
            if ($file){   
            $fileName = $fileUploader->upload($file);
            $data -> setPhoto($fileName);
            }
            $cg->setName($data->getName());
            $em->flush();
            return new RedirectResponse($this->url->generate('app_ds_category'));
        }
        return $this->render('category/index.html.twig', [
            'category_form' => $form->createView(),
        ]);
    }
    #[Route('/category/{id}/delete', name: 'app_delete_category')]
    public function deletecat(EntityManagerInterface $em, int $id,Request $req): Response
    {
        $cg = $em->find(Category::class, $id);
        $em->remove($cg);
        $em->flush();
        return new RedirectResponse($this->url->generate('app_ds_category'));
    }
}

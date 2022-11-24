<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AdminPropertyController extends AbstractController
{
    private PropertyRepository $repository;
    private EntityManagerInterface $manager;

    public function __construct(PropertyRepository $repository,EntityManagerInterface $manager)
    {
        $this->repository = $repository;
        $this->manager=$manager;
    }

    #[Route("/admin/property", name: "app_admin_property")]
    public function index(): Response
    {
        $propertys=$this->repository->findAll();
        return $this->render("admin/property/index.html.twig",[
            'propertys'=>$propertys
        ]);
    }

    #[Route("/admin/property/new", name: "app_admin_property_new")]
    public function new(Request $request): Response
    {
        $property=new Property();
        $form=$this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $property=$form->getData();
            $this->manager->persist($property);
            $this->manager->flush();
            $this->addFlash('success', 'Real estate added successfully');
            return $this->redirectToRoute('app_admin_property');
        }
        return $this->render("admin/property/new.html.twig",[
            'form'=>$form->createView()
        ]);
    }

    #[Route("/admin/property/show/{slug}-{id}", name: "app_admin_property_show")]
    public function show(): Response
    {
        return $this->render("property/show.html.twig");
    }

    #[Route("/admin/property/delete/{id}", name: "app_admin_property_delete")]
    public function delete(Property $property): Response
    {
        $this->manager->remove($property);
        return $this->redirectToRoute("app-admin_property");
    }

    #[Route("/admin/property/edit/{id}", name: "app_admin_property_edit")]
    public function edit(Property $property,Request $request): Response
    {
        $form=$this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $property=$form->getData();
            $this->manager->flush();
            $this->addFlash('success','Real estate edited successfully');
            return $this->redirectToRoute('app_admin_property');

        }
        return $this->render("admin/property/edit.html.twig",[
            'form'=>$form->createView()
        ]);
    }
}
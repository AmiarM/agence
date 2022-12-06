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
use Symfony\Component\HttpFoundation\RequestStack;

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
    public function index(Request $request): Response
    {
        $propertys=$this->repository->findAll();
        $paginations = $paginator->paginate(
            $propertys, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
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
            $this->addFlash('success', 'Property added successfully');
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

    #[Route("/admin/property/delete/{id}", name: "app_admin_property_delete",methods:["POST","DELETE"])]
    public function delete(Property $property,Request  $request): Response
    {
       if($this->isCsrfTokenValid('delete'.$property->getId(),$request->get('_token'))){
            $this->manager->remove($property);
            $this->manager->flush();
            $this->addFlash('success','property deleted successfully');
       }
        return $this->redirectToRoute("app_admin_property");
    }

    #[Route("/admin/property/edit/{id}", name: "app_admin_property_edit", methods: ["POST","GET"])]
    public function edit(Property $property,Request $request): Response
    {
        $form=$this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $property=$form->getData();
            $this->manager->flush();
            $this->addFlash('success','property edited successfully');
            return $this->redirectToRoute('app_admin_property');

        }
        return $this->render("admin/property/edit.html.twig",[
            'form'=>$form->createView()
        ]);
    }
}
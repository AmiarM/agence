<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPropertyController extends AbstractController
{
    private PropertyRepository $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    #[Route("/admin/property", name: "app_admin_property")]
    public function index(): Response
    {
        $propertys=$this->repository->findAll();
        return $this->render("admin/property/index.html.twig",[
            'propertys'=>$propertys
        ]);
    }

    #[Route("/admin/property/add", name: "app_admin_property_add")]
    public function create(): Response
    {
        return $this->render("property/create.html.twig");
    }

    #[Route("/admin/property/show/{slug}-{id}", name: "app_admin_property_show")]
    public function show(): Response
    {
        return $this->render("property/show.html.twig");
    }

    #[Route("/property", name: "app_admin_property_delete")]
    public function delete(): Response
    {
        return $this->redirectToRoute("app_home");
    }

    #[Route("/admin/property/edit/{id}", name: "app_admin_property_edit")]
    public function edit(Property $property): Response
    {
        $form=$this->createForm(PropertyType::class,$property);
        return $this->render("property/update.html.twig",[
            'form'=>$form->createView()
        ]);
    }
}
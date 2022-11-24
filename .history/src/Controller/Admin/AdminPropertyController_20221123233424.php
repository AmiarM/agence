<?php

namespace App\Controller\Admin;

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
        return $this->render("admin/property/index.html.twig");
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

    #[Route("/admin/property/update/{id}", name: "app_admin_property_update")]
    public function update(): Response
    {
        return $this->render("property/update.html.twig");
    }
}
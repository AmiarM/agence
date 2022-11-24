<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    #[Route('/property', name: 'app_property')]
    public function index(): Response
    {
        return $this->render('property/index.html.twig');
    }

    #[Route('/property/add', name: 'app_property_add')]
    public function create(): Response
    {
        return $this->render('property/create.html.twig');
    }

    #[Route('/property/show/{id}', name: 'app_property')]
    public function show(Property $property): Response
    {
        return $this->render('property/show.html.twig');
    }
}
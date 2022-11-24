<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertyController extends AbstractController
{
    private PropertyRepository $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository=$repository;
    }

    #[Route("/property", name: "app_property")]
    public function index(): Response
    {
        $propertys=$this->repository->findAllVisible(); 
        dd($propertys);
        return $this->render("property/index.html.twig",[
            "propertys"=>$propertys
        ]);
    }

    #[Route("/property/add", name: "app_property_add")]
    public function create(): Response
    {
        return $this->render("property/create.html.twig");
    }

    #[Route("/property/show/{slug}-{id}", name: "app_property_show")]
    public function show(Property $property,string $slug): Response
    {
        if($property->getSlug() !== $slug){
            return $this->redirectToRoute('app_property_show',[
                'id'=>$property->getId(),
                'slug'=>$property->getSlug()
            ],301);
        }
        return $this->render("property/show.html.twig",[
            'property'=>$property
        ]); 
    }

    #[Route("/property", name: "app_property_delete")]
    public function delete(): Response
    {
        return $this->redirectToRoute("app_home");
    }

    #[Route("/property/update/{id}", name: "app_property_update")]
    public function update(): Response
    {
        return $this->render("property/update.html.twig");
    }
}
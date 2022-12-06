<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PropertyController extends AbstractController
{
    private PropertyRepository $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository=$repository;
    }

    #[Route("/property", name: "app_property")]
    public function index(Request $request,PaginatorInterface $paginator): Response
    {
        $propertys=$this->repository->findAllVisible(); 
        return $this->render("property/index.html.twig",[
            "propertys"=>$propertys
        ]);
    }

    #[Route("/property/show/{slug}-{id}", name: "app_property_show", requirements: ['slug' => '^[a-z]+(?:-[a-z]+)*$'])]
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
}
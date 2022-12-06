<?php

namespace App\Controller;

use App\Entity\Property;
use App\Entity\Search;
use App\Form\SearchType;
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
        $search=new Search();
        $form=$this->createForm(SearchType::class,$search);
        var_dump($form);
        $form->handleRequest($request);
        
        $all=$this->repository->findAllVisible();
        $propertys = $paginator->paginate(
            $all, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );
        return $this->render("property/index.html.twig",[
            "propertys"=>$propertys,
            "form"=>$form->createView()
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
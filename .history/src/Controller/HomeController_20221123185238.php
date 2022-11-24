<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
 
    #[Route('/', name: 'app_home')]
    public function index(PropertyRepository $repository): Response
    {
        $propertys=$this->repository->findLatest();
        return $this->render('home/index.html.twig',[
            'propertys'=>$propertys
        ]);
    }
}
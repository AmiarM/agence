<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecurityController extends AbstractController
{
    #[Route("/login", name: "app_login", methods: ["POST"])]
     public function login(){
        return $this->render()
     }
}
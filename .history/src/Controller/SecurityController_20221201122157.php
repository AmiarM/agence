<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecurityController extends AbstractController
{
    #[Route("/login", name: "app_login", methods: ["POST"])]
     public function login(){

     }
}
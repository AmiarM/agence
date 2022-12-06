<?php
Namespace App\Controller;

use phpDocumentor\Reflection\Types\AbstractList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegisterController extends AbstractController
{
    #[Route("/register", name: "app_register", methods: ["GET", "POST"])]
    public function register()
    {
        
    }
}
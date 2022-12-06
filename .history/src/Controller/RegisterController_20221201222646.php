<?php
Namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{
    #[Route("/register", name: "app_register", methods: ["GET", "POST"])]
    public function register(Request $request,UserPasswordHasherInterface $hasher)
    {
        $user =new User();
        $form=$this->createForm(RegisterType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user=$form->getData();
            var_dump($user);
        }
       return $this->render('security/register.html.twig',[
            'form'=>$form->createView()
       ]);
    }   
}
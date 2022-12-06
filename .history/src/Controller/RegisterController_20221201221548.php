<?php
Namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use phpDocumentor\Reflection\Types\AbstractList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegisterController extends AbstractController
{
    #[Route("/register", name: "app_register", methods: ["GET", "POST"])]
    public function register(Request $request)
    {
        $user =new User();
        $form=$this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user=$form->getData();
            var_dump($user);
        }
       return $this->render('security/register.html.twig',[
            'form'=>$form->
       ]);
    }   
}
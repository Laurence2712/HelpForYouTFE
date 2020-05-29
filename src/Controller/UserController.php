<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findAll();

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }
    
    /**
     * @Route("/user/{id}", name="user_show")
     */
    public function show(User $user)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->find($user);

        return $this->render('user/show.html.twig', [
            'user' => $user,
          
        ]);
    }

   
}

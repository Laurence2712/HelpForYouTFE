<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RequestType;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user", methods={"GET"})
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
     * @Route("/user/{id}", name="user_show", methods={"GET"})
     */
    public function show(Request $request, User $user)
    {

       
        $this->getUser();
   
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->find($user);

        

        return $this->render('user/show.html.twig', [
            'user' => $user,
            'id' => $user->getId(),     
          
        ]);
    }  


    /**
     * @Route("/user/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user,  UserPasswordEncoderInterface $encoder)
    {
        $this->getUser();

        /*if(!$user){
            $user = new User();

        }*/
     
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        $hash = $encoder->encodePassword($user, $user->getPassword()); 
        $user->setPassword($hash);  
        
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($hash); 
            $this->getDoctrine()->getManager()->flush();
            

            return $this->redirectToRoute('user_show', ['id'=> $user->getId()]);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    } 
    /**
     * @Route("/user/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user');
    }
}

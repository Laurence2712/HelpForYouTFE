<?php

namespace App\Controller;


use App\Entity\Role;
use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends AbstractController
{

    

    /**
     * @Route("/inscription", name="security_registration")
     * @Route("/inscription/{id}/edit", name="profil_edit")
     */
    public function registration(User $user = null, Request $request = null, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        if(!$user){
            $user = new User();

        }

        $defaultRole = $this->getDoctrine()
            ->getRepository(Role::class)
            ->findOneBy(['role' => 'membre']);

       
    
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);  
           

        if($form->isSubmitted() && $form->isValid()){
            if(!$user->getId()){
                $user->setUpdatedAt(new \DateTime());
                
                $user->setImageSize(3);
                $user->setDescription('Pas encore de description');
                $user->setNbPoint(20);   
                $user->setImageName('logo.png');
               
                
            }
          
                     
            $hash = $encoder->encodePassword($user, $user->getPassword()); 
            $user->setPassword($hash);  

            $user->addRole($defaultRole);
     
            $manager->persist($user);
                  
   
            $manager->flush();

            return $this->redirectToRoute("security_login", ['id'=> $user->getId()]);
           
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView(),
            'editMode' => $user->getId() !== null,
        ]);       
    
    }

    /**
     * @Route("/connexion", name="security_login")
     * 
     */
    public function login(User $user = null){
        
    if($user){
     

        return $this->redirectToRoute("prestation", ['id'=> $user->getId()]);

    }
    return $this->render('security/login.html.twig');

    }
     /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout(){
        
    }
}

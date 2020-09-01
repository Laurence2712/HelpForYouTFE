<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Comment;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentController extends AbstractController
{
    

    /**
     * @Route("/comment/{id}", name="comment_show")
     */
    public function show($id)
    {
        $repository = $this->getDoctrine()->getRepository(Comment::class);
        $comment = $repository->find($id);
    
        //dd($comment);

        return $this->render('Comment/show.html.twig', [
            'comment' => $comment,
            
           
        ]);

        }

        /**
     * @Route("/comment/{id}/showComment", name="comment")
     */
    public function showComment(EntityManagerInterface $manager, Request $request, User $user)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class);
        $form->handleRequest($request);

        $this->getUser();
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->find($user);

        $repository = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $repository->findBy(['commentator' => $user->getId()]);
        //dd($comments);

        $userProfile = $this->getDoctrine()
        ->getRepository(User::class)
        ->findBy(['id' => $user->getId()]);

    

        //dd($userProfil);

        
        
        //echo 'id de la personne connectée :'.$this->getUser();
        //echo 'id de la personne commentée (profil) :'.$userProfile[0]->getId();
        //echo 'id de la personne commentée (profil) :'.$userProfile[0]->getFirstname();

        $result = $comments;

        
          
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $comment->setCommentator($this->getUser());
            $comment->setCommented($userProfile[0]);
            $text =$request->request->get('comment','text')['text'];
            $comment->setText($text);
            

            $manager->persist($comment);
            $manager->flush();

          
        return $this->redirectToRoute('user_show_requester', ['id'=> $user->getId()]);
 } 

        return $this->render('comment/index.html.twig', [
            'user' => $user,
            'comments' => $comments,
            'resource' => 'commentaire',
            'id' => $user->getId(),  
            'userProfileFirstname' => $userProfile[0]->getFirstname(),
            'userProfileLastname' => $userProfile[0]->getLastname(),
            'formComment' => $form->createView(),




        ]);
    }
    


    



      /**
     * @Route("/comment/{id}/new", name="comment_new", methods={"GET","POST"})
     */
    /*
    public function form(EntityManagerInterface $manager ,Request $request): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $comment->setUser($this->getUser());
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('comment');
        }

        return $this->render('comment/show.html.twig', [
            'comment' => $comment,
            'formComment' => $form->createView(),
        ]);
    }
*/



}

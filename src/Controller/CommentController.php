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
     * @Route("/comment", name="comment")
     */
    public function index(EntityManagerInterface $manager ,Request $request)

    
    {

        $comment = new Comment();
        $form = $this->createForm(CommentType::class);
        $form->handleRequest($request);

        $repository = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $repository->findAll();
        $commentators = $repository->findAll();
        $commenteds = $repository->findAll();

        //dd($commentators);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
             
            $comments->setCommentator($this->getId()->getCommentator());  //dd($comments->setCommentator($this->getId()->getCommentator()));
            $comments->setCommented($this->getUser()->getCommented);
            $comments->setText($this->getUser()->getText);
            
            $manager->persist($comment);
            $manager->flush();

        return $this->redirectToRoute('comment');
 } 
        return $this->render('comment/index.html.twig', [
            'comments' => $comments,
            'resource' => 'commentaire',
            'commentators' => $commentators,
            'commented' => $commenteds,
            'formComment' => $form->createView(),
        ]);
    }
    

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
            'id'=> $comment->getId(),
           
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

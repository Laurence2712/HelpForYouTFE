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


        


        return $this->render('comment/index.html.twig', [
            'comments' => $comments,
            'resource' => 'COMMENTAIRES',
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

        return $this->render('Comment/show.html.twig', [
            'comment' => $comment,
            'id'=> $comment->getId(),
           
        ]);
    }
}

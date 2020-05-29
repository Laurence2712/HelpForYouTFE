<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
            'resource' => 'CATEGORIES',
        ]);
    }

     /**
     * @Route("/category/{id}", name="category_show")
     */
    public function show($id)
    {

        $repository = $this->getDoctrine()->getRepository(Category::class);
        $category = $repository->find($id);

        return $this->render('category/show.html.twig', [
            'category' => $category,

        ]);
    }

    
}

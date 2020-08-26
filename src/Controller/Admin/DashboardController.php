<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Comment;
use App\Entity\Request;
use App\Entity\Category;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;
use App\Repository\RequestRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Controller\CrudControllerInterface;

class DashboardController extends AbstractDashboardController
{

    protected $userRepository;
    protected $categoryRepository;
    protected $requestRepository;
    protected $commentRepository;

    public function __construct(
    
        UserRepository $userRepository,
        CategoryRepository $categoryRepository,
        RequestRepository $requestRepository,
        CommentRepository $commentRepository
        )
    {


        $this->UserRepository = $userRepository;
        $this->CategoryRepository = $categoryRepository;
        $this->RequestRepository = $requestRepository;
        $this->CommentRepository = $commentRepository;
        

    }



    /**
     * @Route("/admin", name="admin")
     * 
     */
    public function index(): Response
    {
        return $this->render('bundles/EasyAdminBundle/welcome.html.twig', [
            'countAllUser' => $this->UserRepository->countAllUser(),
            'countAllRequest' => $this->RequestRepository->countAllRequest(),
            'categories' => $this->CategoryRepository->findAll(),
            'Commentaires' => $this->CommentRepository->findAll()
          
            ]);
        //return parent::index();
     
  
    
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('HelpForYouTFE');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Catégories', 'fa fa-certificate', Category::class );
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-users', User::class );
        yield MenuItem::linkToCrud('Annonces', 'fa fa-book', Request::class );
        yield MenuItem::linkToCrud('Commentaires', 'fa fa-comment', Comment::class );
        // yield MenuItem::linkToCrud('The Label', 'icon class', EntityClass::class);
        


       

    }
}

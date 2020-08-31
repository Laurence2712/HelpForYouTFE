<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Request;
use App\Entity\Category;
use App\Form\RequestType;
use App\Entity\RequestSearch;
use App\Form\RequestSearchType;
use App\Repository\UserRepository;
use App\Repository\RequestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;





class RequestController extends AbstractController
{
    /**
     * @Route("/request", name="request")
     * 
     */
    public function index(PaginatorInterface $paginator, HttpRequest $httpRequest, UserRepository $userRepository)
    {
        $search = new RequestSearch();
        $form = $this->createForm(RequestSearchType::class, $search);
        $form->handleRequest($httpRequest);
        //dump($httpRequest->query->get('postalCode'));
		$repository = $this->getDoctrine()->getRepository(Request::class);
        if($httpRequest->query->has('postalCode')) {
            $requests = $repository->findBy(['postalCode' => $httpRequest->query->get('postalCode')], ['id' => 'DESC']);
        } else {
            $requests = $repository->findBy([],['id' => 'DESC']);
        }
        //dd($requests);
        $annonces = $paginator->paginate(
            //$repository->findAllVisibleQuery($search),
            $requests,
            $httpRequest->query->getInt('page', 1),
            3
        );


        $users = $userRepository->findAll();
        //dd($users);
        



        return $this->render('request/index.html.twig', [
            'requests' => $requests,
            'annonces' =>$annonces,
            'resource' => 'ANNONCES',
            'users' => $users,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/request/new", name="request_create")
     * @Route("/request/{id}/edit", name="request_edit")
     */
    public function form( Request $request = null, EntityManagerInterface $manager, HttpRequest $httpRequest, FlashyNotifier $flashy ){
        
        $user = $this->getUser();
        if(!$request){
            $request = new Request();
        }
        

        $form = $this->createForm(RequestType::class, $request);
   
        $form->handleRequest($httpRequest);
      
        if($form->isSubmitted() && $form->isValid()){
            if(!$request->getId()){
                //dd($user->getId());
                $request->setCreatedAt(new \DateTime());
                $request->setPostalCode($user->getPostalCode());
                $request->setRequester($user);
               
                
            }
   
            $manager->persist($request);
            $manager->flush();
           
            $flashy->success('success', 'Annonce créée!');

           
            return $this->redirectToRoute('request_show', ['id'=> $request->getId()]);
       
        }

        return $this->render('request/create.html.twig', [
            'formRequest' => $form->createView(),
            'editMode' => $request->getId() !== null,
       
        ]);
 
    }
    /**
     * @Route("/request/{id}", name="request_show")
     */
    public function show($id)
    {
        $repository = $this->getDoctrine()->getRepository(Request::class);
        $request = $repository->find($id);

        return $this->render('request/show.html.twig', [
            'demande' => $request,
        ]);
    }


    /**
     * @Route("/request/{id}/help", name="request_help")
     * 
     */
    public function help($id, HttpRequest $httpRequest)
    {
        $user = $this->getUser();
        
		$repository = $this->getDoctrine()->getRepository(User::class);
        $request = $repository->findBy(['email' => $httpRequest->query->get('email')]);

        //dd($repository->findBy([]));
        //dd($repository->findBy([]));

        //return $this->redirectToRoute('request_show', ['id'=> $request->getId()]);

        return $this->render('request/help.html.twig', [
            'email' => $request,
            'user' => $user,
        ]);
    
    
    }

      /**
     * @Route("/{id}/edit", name="request_edit", methods={"GET","POST"})
     */
    public function edit(Request $request = null, EntityManagerInterface $manager, HttpRequest $httpRequest): Response
    {
        $form = $this->createForm(RequestType::class, $request);
        $form->handleRequest($httpRequest);



        if ($form->isSubmitted() && $form->isValid()) {    
          
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('request_show', ['id'=> $request->getId()]);
        }

        return $this->render('request/edit.html.twig', [
            'request' => $request,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="request_delete", methods={"DELETE"})
     */
    public function delete(Request $request, HttpRequest $httpRequest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$request->getId(), $httpRequest->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($request);
            $entityManager->flush();
        }

        return $this->redirectToRoute('request');
    }



  




}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Prestation;

class PrestationController extends AbstractController
{
    /**
     * @Route("/prestation", name="prestation")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Prestation::class);
        $prestations = $repository->findAll();

        return $this->render('prestation/index.html.twig', [
            'prestations' => $prestations,
            'resource' => '20 points offerts dès l\'inscription',
        ]);
    }

    /**
     * @Route("/prestation/{id}", name="prestation_show")
     */
    public function show($id)
    {
        $repository = $this->getDoctrine()->getRepository(Prestation::class);
        $prestation = $repository->find($id);

        return $this->render('prestation/show.html.twig', [
            'prestation' => $prestation,
           
        ]);
    }
}

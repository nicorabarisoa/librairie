<?php

namespace App\Controller;

use App\Entity\Livre;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivresController extends AbstractController
{
    #[Route('/livres', name: 'app_livres')]
    public function index(ManagerRegistry $doctrine): Response
    {
       /*  $livre = new Livre();
        $livre ->setTitre('Make 1 eth per month')
        ->setAuteur('Vitalik')
        ->setAvis('')
        ->setNote('5.2')
        ->setDateCreation(new \Datetime("2018-05-01"))
        ->setDateModif(null);
        $entityManager = $doctrine->getManager();
        $entityManager->persist($livre);
        $entityManager->flush(); */
       
      
        return $this->render('livres/index.html.twig', [
            'controller_name' => 'LivresController',
            'active_menu' => 'livres'
        ]);
    }
}

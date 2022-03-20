<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Form\LivreType;
use App\Repository\LivreRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Builder\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Livre::class);
        $livres = $repository->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'livres' => $livres
        ]);
    }

    #[Route('/admin', name: 'app_admin')]
    public function index1(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Livre::class);
        $livres = $repository->findAll();
        return $this->render('home/admin.html.twig', compact('livres')
        );
    }
    #[Route('/admin/ajouter', name: 'app_admin_add')]
    public function new(Request $request,ManagerRegistry $doctrine ): Response
    {
        $livre = new Livre;
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager = $doctrine->getManager();
        $entityManager->persist($livre); 
         $entityManager->flush();
         return $this->redirectToRoute('app_admin');
        }
        return $this->render('home/create.html.twig', [ 
            'livre' =>$livre,
            'form' =>$form->createView()
           
        ]
        );
    }
    #[Route('/admin/remove/{id}', name: 'app_admin_delete' )]
    public function delete(Request $request,ManagerRegistry $doctrine,Livre $livre ): Response
    {
        $entityManager = $doctrine->getManager();
        $entityManager->remove($livre);
        $entityManager->flush();
        return $this->redirectToRoute('app_admin');
        
    }
  
    #[Route('/admin/{id}', name: 'app_admin_edit',methods: ['GET','POST'])]
    public function edit(Request $request,ManagerRegistry $doctrine,Livre $livre ): Response
    {
    
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager = $doctrine->getManager();
         $entityManager->flush();
         return $this->redirectToRoute('app_admin');
        }
        dump($form);
        return $this->render('home/edit.html.twig', [ 
            'livre' =>$livre,
            'form' =>$form->createView()
           
        ]
        );
    }
    
  
}

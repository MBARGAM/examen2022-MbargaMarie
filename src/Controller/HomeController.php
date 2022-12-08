<?php

namespace App\Controller;

use App\Entity\Chanson;
use App\Entity\Genre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        // recuperation des chansons et envoi dans la vue pour affichage
        $reqChansons = $entityManager->getRepository(Chanson::class);
        $listeChansons = $reqChansons->findAllChansons();

        return $this->render('home/index.html.twig', [
            'listeChansons' => $listeChansons,
        ]);
    }
}

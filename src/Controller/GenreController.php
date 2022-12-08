<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Form\GenreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GenreController extends AbstractController
{
    /**
     * @Route("/genre", name="genres")
     */
    public function index(EntityManagerInterface $entityManager,Request $request): Response
    {
        // creation d'un formulaire

        $genre = new Genre();
        $form = $this->createForm(GenreType::class,$genre);
        $form->handleRequest($request);

        // verification de la validité du formulaire

        if($form->isSubmitted() && $form->isValid()){
            // recuperation des donnees du formulaire et insertion dans base
            $datas= $form->getData();
                dd(datas);
            //insertion des données dans la bd

            $entityManager->persist($datas);
            $entityManager->flush();
            return $this->redirectToRoute('listeDesGenres');
        }
        return $this->renderForm('chansons/index.html.twig', [
            'form' => $form,
        ]);
    }

// creation d une route afin de recuperer les categories et les envoyer dans la vue
    /**
     * @Route("/listeGenre", name="listeDesGenres")
     */
    public function listeGenre(EntityManagerInterface $entityManager): Response
    {
        $reqGenre = $entityManager->getRepository(Genre::class);
        $listeGenres = $reqGenre->findAllGenres();

        return $this->render('genre/listeGenres.html.twig', [
            'listeGenres' =>  $listeGenres,
        ]);
    }
}

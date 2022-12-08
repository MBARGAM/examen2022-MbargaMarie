<?php

namespace App\Controller;

use App\Entity\Chanson;
use App\Entity\Genre;
use App\Form\ChansonType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChansonsController extends AbstractController
{
    /**
     * @Route("/chansons", name="addChansons")
     */
    public function index(EntityManagerInterface $entityManager,Request $request): Response
    {
        //recuperation de la liste des genres
        $reqGenre = $entityManager->getRepository(Genre::class);
        $listeGenres = $reqGenre->findAllGenres();

        //creation d'une nouvel chanson
        $chanson = new Chanson();

        $form = $this->createForm(ChansonType::class,$chanson);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // recuperation des donnees du formulaire et insertion dans base
            $datas= $form->getData();
            //insertion des données dans la bd
            $entityManager->persist($datas);
            $entityManager->flush();
            return $this->redirectToRoute('accueil');
        }

        return $this->renderForm('chansons/index.html.twig', [
            'listeGenres' =>   $listeGenres,
            'form'=>$form
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="modifierChanson")
     */
    public function modifier($id,EntityManagerInterface $entityManager,Request $request): Response
    {
        //recuperation de la liste des genres
        $reqGenre = $entityManager->getRepository(Genre::class);
        $listeGenres = $reqGenre->findAllGenres();

        // recuperation des details de la chanson choisi et envoi dans la vue pour affichage
        $reqChansons = $entityManager->getRepository(Chanson::class);
        $chanson= $reqChansons->find($id);


        $form = $this->createForm(ChansonType::class,$chanson);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // recuperation des donnees du formulaire et insertion dans base
            $datas= $form->getData();
            //insertion des données dans la bd
            $entityManager->persist($datas);
            $entityManager->flush();
            return $this->redirectToRoute('accueil');
        }

        return $this->renderForm('chansons/index.html.twig', [
            'listeGenres' =>   $listeGenres,
            'form'=>$form
        ]);
    }



    /**
     * @Route("/detail/{id}", name="detailChansons")
     */
    public function detailChanson($id,EntityManagerInterface $entityManager): Response
    {
        // recuperation des details de la chanson choisi et envoi dans la vue pour affichage
        $reqChansons = $entityManager->getRepository(Chanson::class);
        $detailchansons = $reqChansons->find($id);


        return $this->render('chansons/chansonChoisi.html.twig', [
            'detailChansons' => $detailchansons,
        ]);
    }


    /**
     * @Route("/vote/{id}", name="voter",methods="post")
     */
    public function voter($id,EntityManagerInterface $entityManager,Request $request): Response
    {
        $request->request->all();

        // recuperation des details de la chanson choisi et envoi dans la vue pour affichage
        $reqChansons = $entityManager->getRepository(Chanson::class);
        $detailchansons = $reqChansons->find($id);

        if("action" ==="vote"){
            $add = $detailchansons->getVotes()+ 1;
            $detailchansons->setVotes($add);
            $entityManager->persist($detailchansons);
            $entityManager->flush();

        }


        return $this->redirectToRoute('accueil');
    }
}

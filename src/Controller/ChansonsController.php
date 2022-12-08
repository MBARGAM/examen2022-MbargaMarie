<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChansonsController extends AbstractController
{
    /**
     * @Route("/chansons", name="app_chansons")
     */
    public function index(): Response
    {
        return $this->render('chansons/index.html.twig', [
            'controller_name' => 'ChansonsController',
        ]);
    }
}

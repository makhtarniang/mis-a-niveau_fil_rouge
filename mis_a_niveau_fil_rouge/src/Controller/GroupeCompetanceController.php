<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GroupeCompetanceController extends AbstractController
{

    /**
     * @Route("/groupe/competance", name="groupe_competance")
     */
    public function index(): Response
    {
        return $this->render('groupe_competance/index.html.twig', [
            'controller_name' => 'GroupeCompetanceController',
        ]);
    }
}

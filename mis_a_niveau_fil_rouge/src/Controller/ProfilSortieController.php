<?php

namespace App\Controller;

use App\Entity\ProfilSortie;
use App\Repository\PromoRepository;
use App\Repository\ApprenantRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ProfilSortieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilSortieController extends AbstractController
{
    /**
     * @Route("/profil/sortie", name="profil_sortie")
     */



   /* public function index(): Response
    {
        return $this->render('profil_sortie/index.html.twig', [
            'controller_name' => 'ProfilSortieController',
        ]);
    }*/
}

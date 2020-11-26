<?php

namespace App\Controller;

use App\Entity\Niveau;
use App\Entity\Competance;
use App\Repository\CompetanceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CompetanceController extends AbstractController
{
   

   
    
    public function index(): Response
    {
        return $this->render('competance/index.html.twig', [
            'controller_name' => 'CompetanceController',
        ]);
    }
}

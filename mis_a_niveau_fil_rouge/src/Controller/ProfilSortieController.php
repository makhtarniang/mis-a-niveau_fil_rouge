<?php

namespace App\Controller;

use App\Entity\ProfilSortie;
use App\Repository\PromoRepository;
use App\Repository\ApprenantRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ProfilSortieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilSortieController extends AbstractController
{
    /**
     * @Route("/profil/sortie", name="profil_sortie")
     */

    /**
     * Route("/admin/profilsorties", name="postprofilDeSorti",methods={"POST})
     */
    public function postprofilDeSorti(Request $request, EntityManagerInterface $manager){
        $json= json_decode($request->getContent());
        if(isset($json->libelle)){
            $pds  = new ProfilSortie();
            $pds->setLibelle($json->libelle);
           // $pds->setIsdeleted($json->isdeleted);
            $manager->persist($pds);
            $manager->flush();
            return $this->json(['message'=>'succes'],200);
        }else{
            return $this->json(['message'=>'error'],400);
        }
    }

  
}

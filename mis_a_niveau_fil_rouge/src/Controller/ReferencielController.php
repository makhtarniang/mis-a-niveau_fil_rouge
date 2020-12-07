<?php

namespace App\Controller;

use App\Entity\Referenciel;
use App\Repository\PromoRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReferencielRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ApiPlatform\Core\Validator\ValidatorInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReferencielController extends AbstractController
{

    /**
     * @Route(name="createRef",
     *   path="api/admin/referentiels",
     *   methods={"POST"},
     *   defaults={
     *     "_controller"="\app\ControllerreferencielController::createRef",
     *     "_api_resource_class"=Referenciel::class, 
     *     "_api_collection_operation_name"="createRef",
     *    }
     * )
     */

    public function createRef(Request $request,SerializerInterface $serializer,ValidatorInterface $validator,ReferencielRepository  $profil,EntityManagerInterface $manager,PromoRepository $repo)
    {
        $ref = $request->request->all();
        //dd($ref);
        $programme = $request->files->get("programme");
       
        $programme = fopen($programme->getRealPath(),"rb");
        $ref["programme"] = $programme;
        $referentiel = $serializer->denormalize($ref,'App\Entity\Referenciel');
        $promo=$repo->find($ref["promo_id"]);
        $referentiel->setPromo($promo);
        $errors = $validator->validate($referentiel);
        $manager->persist($referentiel);
        $manager->flush();
        fclose($programme);
       return $this->json($serializer->normalize($referentiel,null,["groupeCopetance"=>"Referaniel:read"]),Response::HTTP_CREATED);;
    }
    /**
     * @Route("/referenciel", name="referenciel")
     */
    public function index(): Response
    {
        return $this->render('referenciel/index.html.twig', [
            'controller_name' => 'ReferencielController',
        ]);
    }
}

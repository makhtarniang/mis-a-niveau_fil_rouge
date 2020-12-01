<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Entity\GroupeTag;
use App\Repository\TagRepository;
use App\Repository\GroupeTagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GroupeTagController extends AbstractController
{
/**
     * @Route(name="creategrptag",
     *   path="api/admin/grpetags",
     *   methods={"POST"},
     *   defaults={
     *     "_controller"="\app\ControllerGroupeTagController::AjouGrpTag",
     *     "_api_resource_class"=GroupeTag::class,
     *     "_api_collection_operation_name"="postgrpetag",
     *    }
     * )
     */
    public function AjouGrpTag(Request $request, SerializerInterface $serializer, EntityManagerInterface $manager)
    {
        $grpetag = $request->getContent();
       // dd($grpetag);
        $grpetag = $serializer->deserialize($grpetag, GroupeTag::class, "json");
        $manager->persist($grpetag);
        $manager->flush();
        return $this->json($grpetag, Response::HTTP_CREATED);
    }
    /**
     * @Route(
     *   path="api/admin/grpetags/{id}",
     *   methods={"PUT"},
     *   defaults={
     *     "_controller"="\app\ControllerGroupeTagController::updateGrpTag",
     *     "_api_resource_class"=GroupeTag::class,
     *     "_api_Collection_operation_name"="putgrpetag",
     *    }
     * )
     * 
     */

    public function  updateGrpTag(Request $request,SerializerInterface $serializer,ValidatorInterface $validator,EntityManagerInterface $manager, $id, GroupeTagRepository $repgtag, TagRepository $reptag)
    {
        $GroupeTags_json = $request->getContent();
        $GroupeTags_tab = $serializer->decode($GroupeTags_json,"json");
        if ($GroupeTags = $repgtag -> find($id))
        {
            // Modification libelle de GroupeTag
            if (isset($GroupeTags_tab['libelle'])) 
            {
                $GroupeTags->setLibelle($GroupeTags_tab['libelle']);
            }
            $tag_tab = isset($GroupeTags_tab['tags'])?$GroupeTags_tab['tags']:[];
            if (!empty($tag_tab)) 
            {
                foreach ($tag_tab as $key => $value) {
                        
                        if (isset ($value['id']))
                        {
                            // Affectation de tag
                            if (isset ($value['action']) && ($value['action'])=="affecter")
                            {
                                $GroupeTags->addTag($reptag->find($value['id']));
                            }
                            // Desaffectation de tag
                            else if (isset ($value['action']) && $value['action']=="desaffecter")
                            {
                                $GroupeTags->RemoveTag($reptag->find($value['id']));
                            }
                        
                            // Modification attributs tag
                            else
                            {
                                $tag=$reptag->find ($value['id']);
                                if (isset($value['libelle'])) {
                                    $tag -> setLibelle($value['libelle']);
                                }

                                if (isset($value['descriptif'])){
                                    $tag -> setDescriptif($value['descriptif']);
                                }
                            }
                        }
                            // Création d'un nouveau tag
                        else 
                            if (isset($value['libelle']))
                        {
                            $tag=new Tag();
                            $tag->setLibelle($value['libelle']);
                            $tag -> setDescriptif($value['descriptif']);
                            $GroupeTags->addTag($tag);
                            $manager->persist($tag);
                            $manager->flush();  
                        }
                    
                    }
        }
        $errors = $validator->validate($GroupeTags);
        if (count($errors))
        {
            $errors = $serializer->serialize($errors,"json");
            return new JsonResponse($errors,Response::HTTP_BAD_REQUEST,[],true);
        }
        
        $manager->persist($GroupeTags);
        $manager->flush();
    }
        return $this->json($GroupeTags,Response::HTTP_CREATED);
    }
    /**
     * @Route("/groupe/tag", name="groupe_tag")
     */
    public function index(): Response
    {
        return $this->render('groupe_tag/index.html.twig', [
            'controller_name' => 'GroupeTagController',
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\CM;
use App\Entity\User;
use App\Entity\Profil;
use App\Entity\Formateur;
use App\Repository\ProfilRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ApiPlatform\Core\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route(name="createUser",
     *   path="api/admin/users",
     *   methods={"POST"},
     *   defaults={
     *     "_controller"="\app\ControllerUserController::createUser",
     *     "_api_resource_class"=User::class,
     *     "_api_collection_operation_name"="postUser",
     *    }
     * )
     * @param Request $request
     * @param ValidatorInterface $validator
     * @param SerializerInterface $serializer
     * @param UserPasswordEncoderInterface $encoder
     * @param ProfilRepository $repo
     * @param EntityManagerInterface $manager
     * @return JsonResponse
     */
    public function createUsers(Request $request, ValidatorInterface $validator, SerializerInterface $serializer,
    UserPasswordEncoderInterface $encoder, ProfilRepository $repo, EntityManagerInterface $manager){
     $userJson= json_decode($request->getcontent(), true);
     //dd($userJson);

     $avatar = $request->files->get("avatar");
if ($avatar) {
     $avatar = fopen($avatar->getRealPath(),"rb");
     $userJson['avatar'] = $avatar;
}

    $profil=$repo->find($userJson["profil_id"]);
    $userJson = $serializer->denormalize($userJson, User::class);
    $errors = $validator->validate($userJson);
   // dd("OK");
        $password = $userJson->getPassword();
        $userJson->setPassword($encoder->encodePassword($userJson, $password));
        //$userJson->setIsDeleted(false);

        $userJson->setProfil($profil);
        $manager->persist($userJson);
        $manager->flush();
        if ($avatar){
          fclose($avatar);
        }
        return $this->json($userJson,Response::HTTP_CREATED);
    }


    /**
     * @Route(name="editUser",
     *   path="api/admin/users/{id}",
     *   methods={"PUT"},
     *   defaults={
     *     "_controller"="\app\ControllerUserController::editUser",
     *     "_api_resource_class"=User::class,
     *     "_api_item_operation_name"="editUser",
     *    }
     * )
     * */

    public function editeUser(Request $request,UserPasswordEncoderInterface $encoder,SerializerInterface $serializer,ValidatorInterface $validator,UserRepository $userrep,EntityManagerInterface $manager,$id)
    {
        $data = $request->request->all();
         dd($data['prenom']);
        $user= $userrep->find($id);
        dd($data['prenom']);
        if ($request->files->get("avatar"))
        {
            $avatar = $request->files->get("avatar");
            $avatar = fopen($avatar->getRealPath(),"rb");
            $data["avatar"] = $avatar;
            fclose($avatar);
        }
        if (isset ($data['prenom']))
        {
            $user->setPrenom($data['prenom']);
        }
        if (isset ($data['nom']))
        {
            $user->setnom($data['nom']);
        }
        if (isset ($data['password']))
        {
            $user->setPassword($encoder->encodePassword($user,$data['password']));
        }
        if (isset ($data['email']))
        {
            $user->setEmail($data['email']);
        }
        if (isset ($data['username']))
        {
            $user->setUsername($data['username']);
        }
        $errors= $validator->validate($user);
       if (count($errors)){
            $errors = $serializer->serialize($errors,"json");
            return new JsonResponse($errors,Response::HTTP_BAD_REQUEST,[],true);
        }
        //dd($user);
        $manager->persist($user);
        $manager->flush();
        return $this->json($user,Response::HTTP_CREATED);
    }
    
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}

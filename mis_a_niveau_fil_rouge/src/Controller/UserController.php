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
     *     "_api_collection_operation_name"="createUser",
     *    }
     * )
     */

    public function createUser(Request $request,UserPasswordEncoderInterface $encoder,SerializerInterface $serializer,ValidatorInterface $validator,ProfilRepository $profil,EntityManagerInterface $manager)
    {
        $user = $request->request->all();
        //dd($user);
        $avatar = $request->files->get("avatar");
        $avatar = fopen($avatar->getRealPath(),"rb");
        $user["isDeleted"]=
        $user["avatar"] = $avatar;
        //dd($avatar);
        //dd($user);
        $newprofil=$profil->find($user['profil_id']);
        $user = $serializer->denormalize($user,'App\Entity\User');
        $errors = $validator->validate($user);
        $newprofil->setLibelle("Admin");
        $newprofil->setIsdeleted(false);
        $user -> setProfil($newprofil);
        $user->setIsdeleted(false);
        $password = $user->getPassword();
        $user->setPassword($encoder->encodePassword($user,$password));
        $manager->persist($user);
        $manager->flush();
        fclose($avatar);
       return $this->json($serializer->normalize($user,null,["groups"=>"user:read"]),Response::HTTP_CREATED);;
    }
    
    /**
     * @Route(name="puttUser",
     *   path="api/admin/users/{id}",
     *   methods={"PUT"},
     *   defaults={
     *     "_controller"="\app\ControllerUserController::editUser",
     *     "_api_resource_class"=User::class,
     *     "_api_item_operation_name"="puttUser",
     *    }
     * )
     * */

    public function editUser(Request $request,UserPasswordEncoderInterface $encoder,SerializerInterface $serializer,ValidatorInterface $validator,UserRepository $userrep,EntityManagerInterface $manager,$id)
    {
        $data = $request->request->all();
        // dd($data['prenom']);
        $user= $userrep->find($id);
     //   dd($use);
     //   dd($data['prenom']);
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

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Form\UserFormType;



class UserController extends AbstractController
{
   
    #[Route('/listuser', name: 'list_user')]
    public function ListUser(UserRepository $repository): Response
    {
        
        $users = $repository->findByRole('ROLE_USER');
        return $this->render('user/ListUser.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/user/suppression/{id}', name: 'user_list.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $entityManager, User $user): Response
    {
        if(! $user){
            $this->addFlash('success','l utilisateur n\'a pas été trouvé!');
            return $this->redirecToRoute('list_user');
        }
        $entityManager->remove($user);
        $entityManager->flush();
        
        $this->addFlash('success','l utilisateur a été supprimé avec succés');
 
        return $this->redirectToRoute('list_user');
    }



    #[Route('/newuser', name: 'new_user',methods:['GET','POST'])]
    public function NewUser(
        Request $request, 
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager
     ): Response
    {
        $user = new User();
        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            //par défaut ROLE_USER
            $user->setRoles(array('ROLE_USER'));
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('list_user');
        }

        return $this->render('user/NewUser.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }

}

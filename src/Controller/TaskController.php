<?php

namespace App\Controller;
use App\Repository\TaskRepository;
use App\Entity\Task;
use App\Entity\User;
use App\Form\TaskFormType;
use App\Form\TaskUserFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;


class TaskController extends AbstractController
{
    
    #[Route('/task', name: 'list_task')]
    public function ListTask(TaskRepository $repository): Response
    {
        

        $usersession=$this->getUser();
        $user=$usersession->getRoles();
        //dump($usersession->getId());
        
        if ($user[0]  == 'ROLE_USER'){
            $list_task = $repository->findBy(['user_affect' => $usersession->getId() ]);
            //dump($list_task);
            return $this->render('task/ListTaskUser.html.twig', [
                'list_task' => $list_task,
            ]);
        }
        
        $list_task = $repository->findALL();
        return $this->render('task/ListTask.html.twig', [
            'list_task' => $list_task,
        ]);
    }



    #[Route('/newtask', name: 'new_task',methods:['GET','POST'])]
    public function newtask(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response
    {
        $task = new Task();
        
        $form = $this->createForm(TaskFormType::class, $task);
        $form->handleRequest($request);

       if ($form ->isSubmitted() && $form ->isValid() )
            {   

                $task=$form->getData();
                $task->setStatus('enattente');
                //dd($task);
                $entityManager->persist($task);
                $entityManager->flush();
                $this->addFlash('success', 'Bien crée avec succés');
             return $this->redirectToRoute('list_task');
            }

        return $this->render('task/NewTask.html.twig', [
            'taskForm' => $form->createView(),

        ]);
    }

    #[Route('/task/suppression/{id}', name: 'task_list.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $entityManager, Task $task): Response
    {
        if(! $task){
            $this->addFlash('success','la Tache n\'a pas été trouvé!');
            return $this->redirecToRoute('list_task');
        }
        $entityManager->remove($task);
        $entityManager->flush();
        
        $this->addFlash('success','la tache a été supprimé avec succés');
 
        return $this->redirectToRoute('list_task');
    }

    #[Route('/task/edition/{id}', name: 'task_list_edit', methods: ['GET', 'POST'])]
    public function edit(
        Task $task,
        EntityManagerInterface $entityManager,
        Request $request
    ): Response
    {
        $form = $this->createForm(TaskFormType::class, $task);
        
        $form->handleRequest($request);

        if ($form ->isSubmitted() && $form ->isValid() )
             {   
 
                 $task=$form->getData();
                 $entityManager->persist($task);
                 $entityManager->flush();
                 $this->addFlash('success', 'Bien modifié avec succés');
              return $this->redirectToRoute('list_task');
             }
 
        return $this->renderForm('task/EditTask.html.twig', [
            'taskForm' => $form,
        ]);
    }


    #[Route('/taskUser/edition/{id}', name: 'Usertask_list_edit', methods: ['GET', 'POST'])]
    public function editTaskUser(
        Task $task,
        EntityManagerInterface $entityManager,
        Request $request
    ): Response
    {
        $form = $this->createForm(TaskUserFormType::class, $task);
        
        $form->handleRequest($request);

        if ($form ->isSubmitted() && $form ->isValid() )
             {   
 
                 $task=$form->getData();
                 $entityManager->persist($task);
                 $entityManager->flush();
                 $this->addFlash('success', 'Bien modifié avec succés');
              return $this->redirectToRoute('list_task');
             }
 
        return $this->renderForm('task/EditTaskUser.html.twig', [
            'taskForm' => $form,
        ]);
    }
   

}

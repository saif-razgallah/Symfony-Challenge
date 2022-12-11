<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TaskRepository;
use App\Entity\Task;


class ApiController extends AbstractController
{
    #[Route('/api/alltask', name: 'app_api')]
    public function index(TaskRepository $repository): Response
    {     
        $list_task = $repository->findALL();
        $nbTasks = sizeof($list_task);
        
        $tasks = array();

        for ($i = 0; $i < $nbTasks; $i++) {
            // on compare la fiche départ avec toutes les autres fiches du tableau
            if($list_task[$i]->getUserAffect())
            {
                $tasks[$i] = 
                array( 
                    "id" => $list_task[$i]->getId(),
                    "title" => $list_task[$i]->getTitle(),
                    "subject" => $list_task[$i]->getSubject(),
                    "description" => $list_task[$i]->getDescription(),
                    "status" => $list_task[$i]->getStatus(),
                    "firstname" => $list_task[$i]->getUserAffect()->getLastname(),
                    "lastname" => $list_task[$i]->getUserAffect()->getLastname(),
                );
            }
            else 
            {

                $tasks[$i] = 
                array( 
                    "id" => $list_task[$i]->getId(),
                    "title" => $list_task[$i]->getTitle(),
                    "subject" => $list_task[$i]->getSubject(),
                    "description" => $list_task[$i]->getDescription(),
                    "status" => $list_task[$i]->getStatus(),
                    "firstname" => "",
                    "lastname" => "",
                );
            }
              

        }
       
        return $this->json([$tasks]);
    }
}

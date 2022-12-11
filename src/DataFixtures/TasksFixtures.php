<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Task;

class TasksFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       
        $this->createTask('tkshlerin','collins','skilesdonnelly','enattente',$manager);
        $this->createTask('king','durward','nihil','enattente',$manager);
        $this->createTask('russel','mcdermott','nihil','enattente',$manager);
        $this->createTask('bradley72','collins','skilesdonnelly','enattente',$manager);
        $this->createTask('wolffdeckow','mcdermott','accusantium','enattente',$manager);
        $this->createTask('feeney','durward','accusantium','enattente',$manager);
        $this->createTask('biz','collins','skilesdonnelly','enattente',$manager);
        
        //$manager->persist($task);

        $manager->flush();
    }

    public function createTask(string $title,string $subject,string $description,string $status,ObjectManager $manager)
    {

        $task = new Task();
        $task->setTitle($title);
        $task->setSubject($subject);
        $task->setDescription($description);
        $task->setStatus($status);
        $manager->persist($task);
        return $task;
    }
}

<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use Faker;

class UsersFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder
    ){

    }
    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('saif@gmail.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin,'admin')
        );
        $admin->setFirstname('saif');
        $admin->setLastname('razgallah');
        $admin->setCity('sousse');
        $admin->setPhoneNumber('29732742');
        $manager->persist($admin);

        $faker = Faker\Factory::create('fr_FR'); 

        for($usr=1; $usr <=5; $usr++){

            $user = new User();
            $user->setEmail($faker->email);
            $user->setRoles(['ROLE_USER']);
            $user->setPassword(
                $this->passwordEncoder->hashPassword($user,'secret')
            );
            $user->setFirstname($faker->firstname);
            $user->setLastname($faker->lastname);
            $user->setCity($faker->city);
            $user->setPhoneNumber($faker->e164PhoneNumber);
            $manager->persist($user);
        }
        
        $manager->flush();
    }
}

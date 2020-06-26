<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;



class UserRoleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
       $userRoles = [
            ['email' => 'laurence@gmail.com', 'role' => 'admin'],
            ['email' => 'marius@gmail.com', 'role' => 'admin'],
            ['email' => 'geraldine@gmail.com','role' => 'admin'],
            ['email' => 'danielMarcelin@gmail.com','role' => 'membre'],

        ];

        foreach($userRoles as $record){
            
            $user = $this->getReference($record['email']);
            
            $role = $this->getReference($record['role']);
            
            
            
            //dd($role);
            $user->addRole($role);
           // dd($user);
            $manager->persist($user);
        }

        $manager->flush();
    }

    public function getDependencies(){
        return [
            UserFixtures::class,
            RoleFixtures::class,
        ];
    }
}

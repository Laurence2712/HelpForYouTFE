<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;



class UserRoleFixtures extends Fixture 
{
    public function load(ObjectManager $manager)
    {
      /*  $userRoles = [
            ['firstname' => 'Laurence', 'lastname' => 'Pirard',  'role' => 'admin'],
            /*['firstname' => 'Marius', 'lastname' => 'Von Mayenburg', 'role' => 'membre'],
            ['firstname' => 'Géraldine',  'lastname' => 'Philippe' ,'role' => 'admin'],
            ['firstname' => 'Daniel',  'lastname' => 'Marcelin' ,'role' => 'admin'],

        ];

        foreach($userRoles as $record){
            
            $user = $this->getReference($record['firstname'].'-'.$record['lastname']);
            
            $role = $this->getReference($record['role']);
            
            

            $user->addRole($role);
           //dd($user);
            $manager->persist($user);
        }

        $manager->flush();
    }

    public function getDependencies(){
        return [
            UserFixtures::class,
            RoleFixtures::class,
        ];*/
    }
}

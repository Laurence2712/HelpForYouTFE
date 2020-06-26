<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use App\Entity\Comment;
use App\Entity\Request;
use App\DataFixtures\RoleFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class UserFixtures extends Fixture 
{
    public function load(ObjectManager $manager)
    {
        $users = [
            [
             'firstname' => 'Daniel',
             'lastname' => 'Marcelin',
             'address' => 'Rue de la fontaine bleue 45',
             'postalCode' => '5340',
             'city' => 'Haltinne',
             'email' => 'danielMarcelin@gmail.com',
             'password' => 'testtest',
             'image_name' => 'dany.jpg',
             'image_size' => 2,
             'updated_at' => new \DateTime('2019-01-02'),
             'description' => 'Généralement, j\'ai du temps à consacrer aux gens. 
              Je suis poli, serviable et une personne de confiance',
            ],
            [
             'firstname' => 'Géraldine',
             'lastname' => 'Philippe',
             'address' => 'Rue du bois 30',
             'postalCode' => '5020',
             'city' => 'Vedrin',
             'email' => 'geraldine@gmail.com',
             'password' => 'testtest',
             'image_name' => 'géraldine.jpg',
             'image_size' => 1,
             'updated_at' => new \DateTime('2019-01-02 13:05:21'),
             'description' => 'J\'ai l\'habitude de m\'occuper d\'enfants et d\'animaux',
            ],
            [
       
             'firstname' => 'Marius',
             'lastname' => 'Von Mayenburg',
             'address' => 'Rue de la cité 60',
             'postalCode' => '5000',
             'city' => 'Namur',
             'email' => 'marius@gmail.com',
             'password' => 'testtest',
             'image_name' => 'marius.jpg',
             'image_size' => 2,
             'updated_at' => new \DateTime('2019-01-02 13:21:21'),
             'description' => 'Toujours au service des autres',
            ],
            [
                
            'firstname' => 'Laurence',
            'lastname' => 'Pirard',
            'address' => 'Rue de la joie 360',
            'postalCode' => '1410',
            'city' => 'Waterloo',
            'email' => 'laurence@gmail.com',
            'password' => 'testtest',
            'image_name' => 'laurence.jpg',
            'image_size' => 2,
            'updated_at' => new \DateTime('2020-01-02 13:21:21'),
            'description' => 'Je suis une personne de confiance, j\'ai l\'habitude d\'aider les autres',
           ],
        ];

        
        foreach($users as $record){

            $user = new User();
            $request = new Request();
            $comment = new Comment();
            

        

            $user->setFirstname($record['firstname']);
            $user->setLastname($record['lastname']);

      
            //$this->addReference($record['role'], $user);
           
            //$user->setRole($record['role']);

            $user->setAddress($record['address']);
            $user->setPostalCode($record['postalCode']);
            $user->setCity($record['city']);
            $user->setEmail($record['email']);
            $user->setPassword(password_hash($record['password'], PASSWORD_BCRYPT));
            $user->setImageName($record['image_name']);
            $user->setImageSize($record['image_size']);
            $user->setUpdatedAt($record['updated_at']);
            $user->setDescription($record['description']);

          
            //dd($user);die;
            $this->addReference($record['lastname'], $user);
            $this->addReference($record['firstname'].'-'.$record['lastname'], $user);
            $this->addReference($record['firstname'], $user);
            
            $this->addReference($record['email'], $user);

            $manager->persist($user);

        }
        
        $manager->flush();
        
    }
    /*public function getDependencies(){
        return [
          
            RoleFixtures::class,     
        ];
    } */
}

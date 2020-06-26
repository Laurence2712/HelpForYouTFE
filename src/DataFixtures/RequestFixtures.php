<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Request;
use App\Entity\Category;
//use Doctrine\Migrations\Version\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class RequestFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
      
        $requests = [
            [
                'firstname' => 'Marius',
                'title' => 'Demande d\'assistance',
                'description' => 'Je recherche quelqu\'un qui pourra m\'aider à faire mes courses',
                'nbPoint' => 3,
                'created_at' => new \DateTime('2020-03-02 13:21:21'),   
                'name' => 'assistance',
                'postalCode' => 5000,
  
             
            ],
            [
                'firstname' => 'Laurence',
                'title' => 'Besoin de quelqu\'un pour mes animaux',
                'description' => 'Sortir mon chien pendant 1 semaine',
                'nbPoint' => 2, 
                'created_at' => new \DateTime('2019-06-02 13:21:21'), 
                'name' => 'animaux',
                'postalCode' => 1410,
 
          
            ],
            [
                'firstname' => 'Laurence',
                'title' => 'Un jardinier dans le coin?',
                'description' => 'Besoin qu\'on tonde ma pelouse',
                'nbPoint' => 4,
                'created_at' => new \DateTime('2020-02-02 13:21:21'), 
                'name' => 'jardinage',
                'postalCode' => 1410,
        
             
            ],
            [
                'firstname' => 'Géraldine',
                'title' => 'Camionnette',
                'description' => 'Quelqu\'un aurait-il une camionnette à prêter?',
                'nbPoint' => 2, 
                'created_at' => new \DateTime('2020-01-02 16:21:21'), 
                'name' => 'transport',
                'postalCode' => 5020,
         
           
            ],
            [
                'firstname' => 'Daniel',
                'title' => 'Babysitter',
                'description' => 'Recherche une babysitter pour une heure dans le coin?',
                'nbPoint' => 1, 
                'created_at' => new \DateTime('2020-01-02 10:21:21'),
                'name' => 'enfance', 
                'postalCode' => 5340,
          
                         
            ],
            [
                'firstname' => 'Laurence',
                'title' => 'Taille haie',
                'description' => 'Quelqu\'un aurait un taille haie?',
                'nbPoint' => 1, 
                'created_at' => new \DateTime('2020-01-02 13:21:21'), 
                'name' => 'jardinage',
                'postalCode' => 1410,
   
             
            ],
            [
                'firstname' => 'Daniel',
                'title' => ' Garde de mes enfants',
                'description' => 'Recherche personne de confiance pour garder mon enfant de 7 ans le temps d\'une soirée le week-end prochain',
                'nbPoint' => 2, 
                'created_at' => new \DateTime('2020-05-02 13:21:21'),
                'name' => 'enfance', 
                'postalCode' => 5340,
      
           
            ],
            [
                'firstname' => 'Géraldine',
                'title' => 'Tondeuse',
                'description' => 'Je recherche une tondeuse pour samedi...',
                'nbPoint' => 1,
                'created_at' => new \DateTime('2020-04-02 13:21:21'), 
                'name' => 'jardinage',
                'postalCode' => 5020,
  
            ],
            [
                'firstname' => 'Daniel',
                'title' => 'Déménagement',
                'description' => 'Pour cause de déménagement, je suis à la recherche d\'une camionnette pendant 3 jours',
                'nbPoint' => 5, 
                'created_at' => new \DateTime('2020-03-02 13:21:21'), 
                'name' => 'transport',
                'postalCode' => 5340,

            ],
            [
                'firstname' => 'Daniel',
                'title' => 'test',
                'description' => 'Pour cause de déménagement, je suis à la recherche d\'une camionnette pendant 3 jours',
                'nbPoint' => 5, 
                'created_at' => new \DateTime('2020-03-02 13:21:21'), 
                'name' => 'jardinage',
                'postalCode' => 5340,
     
            ],
        ];

        foreach($requests as $record){
            $request = new Request();
        
            $request->setFirstname($record['firstname']);
            $request->setTitle($record['title']);
            $request->setDescription($record['description']);
            $request->setNbPoint($record['nbPoint']);   
            $request->setCreatedAt($record['created_at']); 
            $request->setPostalCode($record['postalCode']); 
           // $request->setRequester(app.user); 
            //Référence avec la table category
            $refCat = $this->getReference($record['name']);
            //dd($refCat);
            //Référence avec la table User
            $refUser = $this->getReference($record['firstname']);
      
           
            $request->setCategory($refCat);
            $request->setRequester($refUser);
      

            $manager->persist($request);
                
        }
        
        $manager->flush();
    }
    public function getDependencies(){
        return [
            CategoryFixtures::class,
            UserFixtures::class,
       
        ];
    }
}


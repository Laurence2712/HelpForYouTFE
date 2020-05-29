<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Comment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager) 
    {
        $comments = [
            [
             'text' => 'Personne de confiance',
             'firstname' => 'Géraldine', 
             'lastname' => 'Philippe'
            ],
            [
            'text' => 'Très fiable', 
            'firstname' => 'Laurence', 
            'lastname' => 'Pirard'
            ],
            [
            'text' => 'Je recommande!', 
            'firstname' => 'Daniel', 
            'lastname' => 'Marcelin'],
            [
            'text' => 'Prestation à la hauteur de mes attentes', 
            'firstname' => 'Marius', 
            'lastname' => 'Von Mayenburg'
            ],
           
        ];

        foreach($comments as $data){

            $comment = new Comment();
            $comment->setText($data['text']);
            
           
            $refFirstname = $this->getReference($data['firstname'].'-'.$data['lastname']);
            $ref = $this->getReference($data['lastname']);

            $comment->setCommented($ref);
            $comment->setCommentator($refFirstname);

            $manager->persist($comment);
        }

        $manager->flush();
    }
    public function getDependencies(){
        return [
            UserFixtures::class,
        ];
    }
}

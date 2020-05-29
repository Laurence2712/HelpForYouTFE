<?php
namespace App\DataFixtures;

use App\Entity\Category;
use Cocur\Slugify\Slugify;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Request;

class CategoryFixtures extends Fixture 
{
    public function load(ObjectManager $manager)
    {
        $categories = [
            
            ['name' => 'assistance', 'image' => 'assistance.jpg'],
            ['name' => 'animaux', 'image' => 'animaux.jpg'],
            ['name' => 'enfance', 'image' => 'enfance.jpg'],
            ['name' => 'transport', 'image' => 'transport.jpg'],
            ['name' => 'jardinage', 'image' => 'jardinage.jpg'],

        ];

        foreach($categories as $record){

            $category = new Category();
            $request = new Request();

            $this->addReference($record['name'], $category);
            $category->setName($record['name']);    
            $category->setImage($record['image']);           
            $manager->persist($category);     


            
        }
        $manager->flush();
    }
    
}

<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Prestation;

class PrestationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $prestations = [
            [
                'nbChoice' => 1,
                'name'=>'Prestataire',
                'description'=> 'Rendez service autour de vous en faisant des choses que vous aimez et collectez des points en retour. Ces points vous permettront de recevoir à votre tour des coups de pouce !'],

            [
                'nbChoice' => 2, 
                'name'=>'bénéficiaire',
                'description'=> 'Grâce aux points reçus à l\'inscription, vous pouvez demander de l\'aide auprès des personnes vivant à côté de chez vous'],
        ];

        foreach($prestations as $record){

            $prestation = new Prestation();
            $prestation->setNbChoice($record['nbChoice']);
            $prestation->setName($record['name']);
            $prestation->setDescription($record['description']);
            

            $manager->persist($prestation);
        }


        $manager->flush();
    }
}

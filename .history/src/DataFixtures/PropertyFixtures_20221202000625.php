<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
      for ($i=0; $i < 100; $i++) { 
        $property=new Property();
        $property->setTitle($faker->name())
        ->setDescription($faker->text())
        ->setRooms();
      }

        $manager->flush();
    }
}
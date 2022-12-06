<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Property;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
      for ($i=0; $i < 100; $i++) { 
        $property=new Property();
        $property->setTitle($faker->name())
        ->setDescription($faker->text())
        ->setRooms();
      }

        $manager->flush();
    }
}
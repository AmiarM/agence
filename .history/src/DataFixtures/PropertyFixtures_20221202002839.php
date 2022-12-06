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
        ->setRooms($faker->numberBetween(1,9))
        ->setBedrooms($faker->numberBetween(2,10))
        ->setFloor($faker->numberBetween(1,9))
        ->setSurface($faker->numberBetween(20,350))
        ->setCity($faker->cityName())
        ->setAddress($faker->address())
        ->setSold(false)
        ;
      }

        $manager->flush();
    }
}
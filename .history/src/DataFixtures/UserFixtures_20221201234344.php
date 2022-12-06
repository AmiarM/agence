<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
       for($i=0;$i<10;$i++){
            $user = new User();
            $user->setFirstName($faker->firstname())
            ->setLastName($faker->lastname())
            ->setEmail($faker->email())
            ->setPassword($this->hasher->hashPassword($user,'password'));
            $manager->persist($user);
       }

        $manager->flush();
    }
}
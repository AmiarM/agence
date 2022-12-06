<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        private UserPasswordHasherInterface $hasher;
        public function __construct(UserPasswordHasherInterface $hasher)
        {
            $this->hasher=$hasher;
        }
       $user=new User();
        $manager->persist($user);

        $manager->flush();
    }
}
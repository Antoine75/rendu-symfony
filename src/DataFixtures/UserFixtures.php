<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher){}

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('admin@admin.com');
        $admin->setPassword(
            $this->hasher->hashPassword($admin, 'admin')
        );
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);


        for ($usr = 1; $usr <=5; $usr++){
            $user = new User();
            $user->setEmail("test".$usr. "@test.com");
            $user->setPassword(
                $this->hasher->hashPassword($user, 'secret')
            );
            $manager->persist($user);
        }

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\ProjectCategory;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {



        foreach (['Peppermint', 'Eurofeu', 'Ynergie'] as $name) {
            $projectCategory = new ProjectCategory();
            $projectCategory->setName($name);

            $manager->persist($projectCategory);
            $manager->flush();


            for ($i = 1; $i <=4; $i++) {
                $project = new Project;
                $project->setName("Salut ". $i);
                $project->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sit amet efficitur neque, et ornare lorem. Nam ull");
                $project->setProjectCategory($projectCategory);

                $manager->persist($project);
            }
            $manager->flush();
        }
    }
}

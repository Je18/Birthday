<?php

namespace App\DataFixtures;

use App\Entity\Birthday;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 50; $i++) {
            $birthday = new Birthday();
            $rand = random_int(10, 500);
            $birthday->setNom('Joe'.$rand);
            $birthday->setPrenom('Doe');
            $birthday->setDate(new \DateTime(sprintf('2000-05-02')));            
            $manager->persist($birthday);
        }

        $manager->flush();

    }
}

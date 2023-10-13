<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServiceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {

            $service = new Service();
            $service->setNom($faker->word)
                ->setCreatedAt(new \DateTimeImmutable())    
                ->setLogo("https://picsum.photos/id/23$i/200/$i"."00");

            $manager->persist($service);
        }

        $manager->flush();
    }
}

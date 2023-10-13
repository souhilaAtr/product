<?php

namespace App\DataFixtures;
use Faker\Factory;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProduitFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {   $faker = Factory::create('fr_FR');
      for($i = 0; $i<5 ; $i++){
           
           $produit = new Product();

       $produit->setNomProduit($faker->firstName);
       $produit->setCategorie($faker->lastName);
            $manager->persist($produit);
          
      }
     
        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CategoryFixtures extends Fixture
{
    const CATEGORIES=[
        "Action",
        "Aventure",
        "Animation",
        "Fantastique",
        "Horreur"
    ];
    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');
        foreach(self::CATEGORIES as $key=>$categoryName){
            $category=new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $this->addReference('categorie_' . $key, $category);

        }
        for ($i = 5; $i <= 1000; $i++) {
            $category = new Category();
            $category->setName($faker->word);
            $manager->persist($category);
            $this->addReference('categorie_' . $i, $category);

            $manager->flush();
        }

    }
}
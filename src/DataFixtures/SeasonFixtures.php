<?php


namespace App\DataFixtures;


use App\Entity\Season;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $slugify= new Slugify;
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 50; $i++) {
            $season = new Season();
            $season->setDescription($faker->randomDigit);
            $slug = $slugify->generate($season->getDescription());
            $season->setSlug($slug);
            $season->setYear($faker->year);
            $season->setProgram($this->getReference('program_'.random_int(0, 5)));
            $this->addReference('season_'.$i, $season);
            $manager->persist($season);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }
}
<?php


namespace App\DataFixtures;


use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    const ACTORS = [
        'Andrew Lincoln',
        'Norman Reedus',
        'Lauren Cohan',
        'Danai Gurira'
    ];

    public function load (ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');
        $i=0;

        foreach (self::ACTORS as $name){

            $actor= new Actor();
            $actor->setName($name);
            $actor->addProgram($this->getReference('program_0'));
            $manager->persist($actor);
          ;
        }
        for ($i=0 ; $i<50 ; $i++){
            $actor=new Actor();
            $actor->setName($faker->name);
            $actor->addProgram($this->getReference('program_'.random_int(0, 5)));
            $manager->persist($actor);
        }
        $manager->flush();

    }

    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }
}
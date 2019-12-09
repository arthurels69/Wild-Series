<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
   {
         $this->passwordEncoder = $passwordEncoder;
   }
    public function load(ObjectManager $manager)
    {
        // Création d’un utilisateur de type “auteur”
        $subscriberauthor = new User();
        $subscriberauthor->setEmail('ath@wild.com');
        $subscriberauthor->setRoles(['ROLE_SUBSCRIBERAUTHOR']);
        $subscriberauthor->setUser(null);
        $subscriberauthor->setPassword($this->passwordEncoder->encodePassword(
            $subscriberauthor,
            'aze'
        ));

        $manager->persist($subscriberauthor);

        // Création d’un utilisateur de type “administrateur”
        $admin = new User();
        $admin->setEmail('admin@monsite.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $subscriberauthor->setUser(null);
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'adminpassword'
        ));

        $manager->persist($admin);

        $manager->flush();
    }
}

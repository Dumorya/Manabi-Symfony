<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setFirstName("Pierre");
        $user->setLastName("Jéhan");
        $user->setEmail("pierre@jehan.com");
        $user->setPassword($this->passwordEncoder->encodePassword($user, "dev"));
        $user->setRoles(["ROLE_ADMIN"]);

        $this->addReference("user-pierre", $user);

        $manager->persist($user);
        $manager->flush();
    }
}

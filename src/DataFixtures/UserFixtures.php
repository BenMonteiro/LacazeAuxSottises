<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $admin = new User();
        $admin->setUsername('lacaze_admin');
        $admin->setRoles(['ROLE_ADMIN', 'ROLE_USER']);

        $password = $this->encoder->encodePassword($admin, 'test2020');
        $admin->setPassword($password);

        $manager->persist($admin);

        $user = new User();
        $user->setUsername('lacaze_user');
        $user->setRoles(['ROLE_USER']);

        $password = $this->encoder->encodePassword($user, 'test2020');
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();
    }
}

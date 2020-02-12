<?php

namespace App\DataFixtures;

use Nelmio\Alice\Loader\NativeLoader;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class Fixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $loader = new NativeLoader();
        $objectSet = $loader->loadFile(__DIR__ . '/fixtures.yaml')->getObjects();
        foreach ($objectSet as $object) {
            $manager->persist($object);
        }

        $manager->flush();

        $user = new User();
        $user->setUsername('lacaze_admin');
        $user->setRoles(['ROLE_ADMIN']);

        $password = $this->encoder->encodePassword($user, 'test2020');
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();
    }
}

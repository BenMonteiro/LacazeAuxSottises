<?php

namespace App\DataFixtures;

use Nelmio\Alice\Loader\NativeLoader;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;

class MenuAndSectionsFixtures extends Fixture implements FixtureInterface, ContainerAwareInterface
{

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $webPath = $this->container->getParameter('app_path_to_web');

        $loader = new NativeLoader();
        $objectSet = $loader->loadFile(__DIR__ . '/menuAndSectionsFixtures.yaml')->getObjects();
        foreach ($objectSet as $object) {
            if (method_exists($object, 'setImageFile')) {
                $src = $webPath . '/images/uploads/paragraphImage/640x360.png';
                $file = $this->setFile($src, '640x360.png', 'png');

                $object->setImageFile($file);
                $manager->persist($object);
            }
            $manager->flush();
        }
    }

    public function setFile($src, $name, $type)
    {
        return new UploadedFile(
            $src,
            $name,
            $type,
            null,
            true //  Set test mode true !!! " Local files are used in test mode hence the code should not enforce HTTP uploads."
        );
    }
}

<?php

namespace App\DataFixtures;

use Nelmio\Alice\Loader\NativeLoader;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PressDocFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $loader = new NativeLoader();
        $objectSet = $loader->loadFile(__DIR__ . '/pressDocFixtures.yaml')->getObjects();
        foreach ($objectSet as $object) {
            $src = "C:/wamp64/www/P5/Lacaze_aux_sottises/public/images/uploads/pressDocs/640x360.png";
            $file = $this->setFile($src, '640x360.png', 'png');

            $object->setDocumentFile($file);
            $manager->persist($object);

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

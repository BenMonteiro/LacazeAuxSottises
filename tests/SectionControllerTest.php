<?php

namespace App\Tests;

use App\Entity\Section;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SectionControllerTest extends WebTestCase
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    /**
     * @dataProvider providePerfUrls
     */
    public function testPageIsSuccessful($url)
    {
        $client = static::createClient();
        $client->request('GET', $url);

        echo $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function providePerfUrls()
    {
        return array(
            array('/section/'),
            array('/section/new'),
            array('/section/605'),
            array('/section/605/edit'),
            array('/section/association/presentation'),
        );
    }

    public function testAddSection()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/section/new');

        $form = $crawler->selectButton('Enregistrer')->form();
        $form['section[name]'] = 'test';
        $form['section[belongToPage]'] = 'association/adhésion';
        $form['section[appearanceOrder]'] = 1;
        $form['section[content]'] = 'test';
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Paragraphes');

        $section = $this->entityManager
            ->getRepository(Section::class)
            ->findOneBy(['name' => 'test']);

        $this->assertSame('test', $section->getName());

        return $sectionId = $section->getId();
    }

    /**
     * @depends testAddSection
     */
    public function testEditSection($sectionId)
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/section/' . $sectionId . '/edit');

        $form = $crawler->selectButton('Mettre à jour')->form();
        $form['section[name]'] = 'testEdit';
        $form['section[belongToPage]'] = 'association/adhésion';
        $form['section[appearanceOrder]'] = 2;
        $form['section[content]'] = 'testEdit';
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Paragraphes');

        $section = $this->entityManager
            ->getRepository(Section::class)
            ->findOneBy(['name' => 'testEdit']);

        $this->assertSame('testEdit', $section->getName());

        return $sectionId = $section->getId();
    }

    /**
     * @depends testEditSection
     */
    public function testDeleteSection($sectionId)
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/section/' . $sectionId);

        $form = $crawler->selectButton('Supprimer')->form();
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Paragraphes');
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}

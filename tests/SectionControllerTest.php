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
    private $client;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    protected function dbConnect()
    {
        $this->client = static::createClient(
            [],
            [
                'PHP_AUTH_USER' => 'test',
                'PHP_AUTH_PW' => 'test2020',
            ]
        );
    }

    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $this->dbConnect();
        $this->client->request('GET', $url);

        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function urlProvider()
    {
        $id = 405;
        yield ['/admin/section/'];
        yield ['/admin/section/new'];
        yield ['/admin/section/' . $id];
        yield ['/admin/section/' . $id . '/edit'];
    }

    /**
     * @dataProvider provideAddSectionData
     */
    public function testAddSection($entry, $formDatas)
    {
        $this->dbConnect();

        $crawler = $this->client->request('GET', '/admin/section/new');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('Enregistrer')->form($formDatas);
        $crawler = $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Paragraphes');

        $this->assertSelectorTextContains('table', $entry);
    }

    /**
     * @dataProvider provideEditSectionData
     */
    public function testEditSection($entry, $formDatas)
    {
        $section = $this->entityManager
            ->getRepository(Section::class)
            ->findOneBy(['name' => 'SectionAdd']);

        $this->assertSame('SectionAdd', $section->getName());

        $sectionId = $section->getId();

        $this->dbConnect();

        $crawler = $this->client->request('GET', '/admin/section/' . $sectionId . '/edit');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('Mettre à jour')->form($formDatas);
        $crawler = $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Paragraphes');

        $this->assertSelectorTextNotContains('table', $section->getName());

        $this->assertSelectorTextContains('table', $entry);
    }

    /**
     * @depends testEditSection
     */
    public function testDeleteSection()
    {
        $section = $this->entityManager
            ->getRepository(Section::class)
            ->findOneBy(['name' => 'SectionEdit']);

        $this->assertSame('SectionEdit', $section->getName());

        $sectionId = $section->getId();

        $this->dbConnect();

        $crawler = $this->client->request('GET',  '/admin/section/' . $sectionId . '/edit');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('Supprimer')->form();
        $crawler = $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Paragraphes');

        $this->assertSelectorTextNotContains('table', $section->getName());
    }

    public function provideAddSectionData()
    {
        return [
            'add' => [
                'SectionAdd',
                'section' =>
                [
                    'section[name]' => 'SectionAdd',
                    'section[belongToPage]' => 112,
                    'section[appearanceOrder]' => 1,
                    'section[content]' => 'test'
                ]
            ],
        ];
    }

    public function provideEditSectionData()
    {
        return [
            'edit' => [
                'SectionEdit',
                'section' =>
                [
                    'section[name]' => 'SectionEdit',
                    'section[belongToPage]' => 112,
                    'section[appearanceOrder]' => 5,
                    'section[content]' => 'testtest'
                ]
            ],
        ];
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}

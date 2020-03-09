<?php

namespace App\Tests;

use App\Entity\Partners;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PartnerControllerTest extends WebTestCase
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
                'PHP_AUTH_USER' => 'lacaze_admin',
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
        $this->setUp();

        $partner = $this->entityManager
            ->getRepository(Partners::class)
            ->findOneBy([]);

        $id = $partner->getId();

        yield ['/admin/partners/'];
        yield ['/admin/partners/new'];
        yield ['/admin/partners/' . $id . '/edit'];
    }

    /**
     * @dataProvider provideAddPartnerData
     */
    public function testAddPartners($entry, $formDatas)
    {
        $this->dbConnect();

        $crawler = $this->client->request('GET', '/admin/partners/new');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('Enregistrer')->form($formDatas);
        $crawler = $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Partenaires');

        $this->assertSelectorTextContains('table', $entry);
    }

    /**
     * @dataProvider provideEditPartnerData
     */
    public function testEditPartners($entry, $formDatas)
    {
        $partner = $this->entityManager
            ->getRepository(Partners::class)
            ->findOneBy(['name' => 'Aux Délices d\'Amatxi']);

        $this->assertSame('Aux Délices d\'Amatxi', $partner->getName());

        $partnerId = $partner->getId();

        $this->dbConnect();

        $crawler = $this->client->request('GET', '/admin/partners/' . $partnerId . '/edit');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('Mettre à jour')->form($formDatas);
        $crawler = $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Partenaires');

        $this->assertSelectorTextNotContains('table', $partner->getName());

        $this->assertSelectorTextContains('table', $entry);
    }


    public function testDeletePartners()
    {
        $partner = $this->entityManager
            ->getRepository(Partners::class)
            ->findOneBy(['name' => 'Chez Mireille']);

        $this->assertSame('Chez Mireille', $partner->getName());

        $partnerId = $partner->getId();

        $this->dbConnect();

        $crawler = $this->client->request('GET', '/admin/partners/' . $partnerId . '/edit');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('Supprimer')->form();
        $crawler = $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Partenaires');

        $this->assertSelectorTextNotContains('table', $partner->getName());
    }

    public function provideAddPartnerData()
    {
        return [
            'add' => [
                'Aux Délices d\'Amatxi',
                'partners' => [
                    'partners[name]' => 'Aux Délices d\'Amatxi'
                ]
            ],
        ];
    }

    public function provideEditPartnerData()
    {
        return [
            'edit' => [
                'Chez Mireille',
                'partners' => [
                    'partners[name]' => 'Chez Mireille'
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

<?php

namespace App\Tests;

use App\Entity\Performance;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PerformanceControllerTest extends WebTestCase
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
        $id = 251;
        yield ['/admin/performance/'];
        yield ['/admin/performance/new'];
        yield ['/admin/performance/' . $id . '/edit'];
    }

    /**
     * @dataProvider provideAddPerfData
     */
    public function testAddPerformance($entry, $formDatas)
    {
        $this->dbConnect();

        $crawler = $this->client->request('GET', '/admin/performance/new');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('Enregistrer')->form($formDatas);
        $crawler = $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Représentations');

        $this->assertSelectorTextContains('table', $entry);
    }

    /**
     * @dataProvider provideEditPerfData
     */
    public function testEditPerformance($entry, $formDatas)
    {
        $perf = $this->entityManager
            ->getRepository(Performance::class)
            ->findOneBy(['cityShow' => 'testAdd']);

        $this->assertSame('testAdd', $perf->getCityShow());

        $perfId = $perf->getId();

        $this->dbConnect();

        $crawler = $this->client->request('GET', '/admin/performance/' . $perfId . '/edit');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('Mettre à jour')->form($formDatas);
        $crawler = $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSelectorTextNotContains('table', $perf->getCityShow());

        $this->assertSelectorTextContains('table', $entry);
    }

    public function testDeletePerformance()
    {
        $perf = $this->entityManager
            ->getRepository(Performance::class)
            ->findOneBy(['cityShow' => 'testEdit']);

        $this->assertSame('testEdit', $perf->getCityShow());

        $perfId = $perf->getId();

        $this->dbConnect();

        $crawler = $this->client->request('GET', '/admin/performance/' . $perfId . '/edit');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('Supprimer')->form();
        $crawler = $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSelectorTextNotContains('table', $perf->getCityShow());
    }

    public function provideAddPerfData()
    {
        return [
            'add' => [
                'testAdd',
                'performance' =>
                [
                    'performance[company]' => 86,
                    'performance[cityShow]' => 'testAdd',
                    'performance[placeShow]' => 'place du marché'
                ]
            ],
        ];
    }

    public function provideEditPerfData()
    {
        return [
            'edit' => [
                'testEdit',
                'performance' =>
                [
                    'performance[cityShow]' => 'testEdit',
                    'performance[placeShow]' => 'port de peche'
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

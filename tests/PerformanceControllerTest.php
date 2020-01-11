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

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testAddPerformance()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/performance/new');

        $form = $crawler->selectButton('Enregistrer')->form();
        $form['performance[companyName]'] = 10;
        $form['performance[cityShow]'] = 'TestAdd';
        $form['performance[placeShow]'] = 'TestAdd';
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Représentations');
    }

    public function testSearchBy()
    {

        $perf = $this->entityManager
            ->getRepository(Performance::class)
            ->findOneBy(['cityShow' => 'TestAdd']);

        $this->assertSame('TestAdd', $perf->getCityShow());

        return $perfId = $perf->getId();
    }

    /**
     * @depends testSearchBy
     */
    public function testEditPerformance($perfId)
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/performance/' . $perfId . '/edit');

        $form = $crawler->selectButton('Mettre à jour')->form();
        $form['performance[cityShow]'] = 'testEdit';
        $form['performance[placeShow]'] = 'testEdit';
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Représentations');

        $perf = $this->entityManager
            ->getRepository(Performance::class)
            ->findOneBy(['cityShow' => 'testEdit']);

        $this->assertSame('testEdit', $perf->getCityShow());

        return $perfId = $perf->getId();
    }

    /**
     * @depends testEditPerformance
     */
    public function testDeletePerformance($perfId)
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/performance/' . $perfId . '/edit');

        $form = $crawler->selectButton('Supprimer')->form();
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Représentations');
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
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
            array('/performance/'),
            array('/performance/new'),
            array('/performance/10/edit'),
        );
    }
}

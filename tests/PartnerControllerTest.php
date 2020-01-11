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

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    /**
     * @dataProvider providePartnerUrls
     */
    public function testPageIsSuccessful($url)
    {
        $client = static::createClient();
        $client->request('GET', $url);

        echo $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function providePartnerUrls()
    {
        return array(
            array('/partners/'),
            array('/partners/new'),
            array('/partners/10/edit'),
        );
    }

    public function testAddPartners()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/partners/new');

        $form = $crawler->selectButton('Enregistrer')->form();
        $form['partners[name]'] = 'x';
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Partenaires');
    }

    public function testSearchBy()
    {
        $partner = $this->entityManager
            ->getRepository(Partners::class)
            ->findOneBy(['name' => 'x']);

        $this->assertSame('x', $partner->getName());

        return $partnerId = $partner->getId();
    }

    /**
     * @depends testSearchBy
     */
    public function testEditPartners($partnerId)
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/partners/' . $partnerId . '/edit');

        $form = $crawler->selectButton('Mettre à jour')->form();
        $form['partners[name]'] = 'xxx';
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Partenaires');

        $partner = $this->entityManager
            ->getRepository(Partners::class)
            ->findOneBy(['name' => 'xxx']);

        $this->assertSame('xxx', $partner->getName());

        return $partnerId = $partner->getId();
    }

    /**
     * @depends testEditPartners
     */
    public function testDeletePartners($partnerId)
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/partners/' . $partnerId . '/edit');;

        $form = $crawler->selectButton('Supprimer')->form();
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Partenaires');
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}

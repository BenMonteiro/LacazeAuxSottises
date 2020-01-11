<?php

namespace App\Tests;

use App\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventControllerTest extends WebTestCase
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

    public function testAddEvent()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/event/new');

        $form = $crawler->selectButton('Enregistrer')->form();
        $form['event[name]'] = 'x';
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Événements');
    }

    public function testSearchAddedEvent()
    {
        $event = $this->entityManager
            ->getRepository(Event::class)
            ->findOneBy(['name' => 'x']);

        $this->assertSame('x', $event->getName());

        return $eventId = $event->getId();
    }

    /**
     * @depends testSearchAddedEvent
     */
    public function testEditEvent($eventId)
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/event/' . $eventId . '/edit');

        $form = $crawler->selectButton('Mettre à jour')->form();
        $form['event[name]'] = 'xxx';

        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Événements');
    }

    public function testSearchEditedEvent()
    {

        $event = $this->entityManager
            ->getRepository(Event::class)
            ->findOneBy(['name' => 'xxx']);

        $this->assertSame('xxx', $event->getName());

        return $eventId = $event->getId();
    }

    /**
     * @depends testSearchEditedEvent
     */
    public function testDeleteEvent($eventId)
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/event/' . $eventId);

        $form = $crawler->selectButton('Supprimer')->form();
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Événements');
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }

    /**
     * @dataProvider provideEventUrls
     */
    public function testEventPageIsSuccessful($url)
    {
        $client = static::createClient();
        $client->request('GET', $url);

        echo $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function provideEventUrls()
    {
        return array(
            array('/event/'),
            array('/event/new'),
            array('/event/5'),
            array('/event/5/edit'),
        );
    }
}

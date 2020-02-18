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
        $this->setUp();

        $event = $this->entityManager
            ->getRepository(Event::class)
            ->findOneBy([]);

        $id = $event->getId();

        yield ['/admin/event/'];
        yield ['/admin/event/new'];
        yield ['/admin/event/' . $id];
        yield ['/admin/event/' . $id . '/edit'];
        yield ['/event/' . $id];
    }

    /**
     * @dataProvider provideAddEventData
     */
    public function testAddEvent($entry, $formDatas)
    {
        $this->dbConnect();

        $crawler = $this->client->request('GET', '/admin/event/new');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('Enregistrer')->form($formDatas);
        $crawler = $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Événements');

        $this->assertSelectorTextContains('table', $entry);
    }

    /**
     * @dataProvider provideEditEventData
     */
    public function testEditEvent($entry, $formDatas)
    {
        $event = $this->entityManager
            ->getRepository(Event::class)
            ->findOneBy(['name' => 'AddEvent']);

        $this->assertSame('AddEvent', $event->getName());

        $eventId = $event->getId();

        $this->dbConnect();

        $crawler = $this->client->request('GET', '/admin/event/' . $eventId . '/edit');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('Mettre à jour')->form($formDatas);
        $crawler = $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Événements');

        $this->assertSelectorTextNotContains('table', $event->getName());

        $this->assertSelectorTextContains('table', $entry);
    }

    public function testDeleteEvent()
    {
        $event = $this->entityManager
            ->getRepository(Event::class)
            ->findOneBy(['name' => 'EditEvent']);

        $this->assertSame('EditEvent', $event->getName());

        $eventId = $event->getId();

        $this->dbConnect();

        $crawler = $this->client->request('GET', '/admin/event/' . $eventId);

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('Supprimer')->form();
        $crawler = $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Événements');

        $this->assertSelectorTextNotContains('table', $event->getName());
    }

    public function provideAddEventData()
    {
        return [
            'add' => [
                'AddEvent',
                'event' =>
                [
                    'event[name]' => 'AddEvent',
                ]
            ],
        ];
    }

    public function provideEditEventData()
    {
        return [
            'add' => [
                'EditEvent',
                'event' =>
                [
                    'event[name]' => 'EditEvent'
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

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

    /**
     * @dataProvider provideUrls
     */
    public function testPageIsSuccessful($url)
    {
        $client = static::createClient();
        $client->request('GET', $url);

        echo $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function provideUrls()
    {

        return array(
            array('/event/'),
            array('/event/new'),
            array('/event/284'),
            array('/event/284/edit'),
        );
    }
    public function testAddEvent()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/event/new');

        $form = $crawler->selectButton('Enregistrer')->form();
        $form['event[name]'] = 'x';
        $form['event[startingDate][day]'] = '15';
        $form['event[startingDate][month]'] = '2';
        $form['event[startingDate][year]'] = '2020';
        $form['event[endingDate][day]'] = '15';
        $form['event[endingDate][month]'] = '2';
        $form['event[endingDate][year]'] = '2020';
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Événements');

        $event = $this->entityManager
            ->getRepository(Event::class)
            ->findOneBy(['name' => 'x']);

        $this->assertSame('x', $event->getName());

        return $eventId = $event->getId();
    }

    /**
     * @depends testAddEvent
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

        $event = $this->entityManager
            ->getRepository(Event::class)
            ->findOneBy(['name' => 'xxx']);

        $this->assertSame('xxx', $event->getName());

        return $eventId = $event->getId();
    }

    /**
     * @depends testEditEvent
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
}

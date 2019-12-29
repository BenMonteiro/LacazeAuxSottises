<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventControllerTest extends WebTestCase
{
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

    public function testEditEvent()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/event/{id}/edit');

        $form = $crawler->selectButton('Mettre à jour')->form();
        $form['event[name]'] = 'xxx';
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Événements');
    }

    public function testDeleteEvent()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/event/{id}');

        $form = $crawler->selectButton('Supprimer')->form();
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Événements');
    }
}

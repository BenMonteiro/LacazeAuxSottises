<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SectionControllerTest extends WebTestCase
{
    public function testAddSection()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/section/new');

        $form = $crawler->selectButton('Enregistrer')->form();
        $form['section[name]'] = 'w';
        $form['section[pageSlug]'] = 'association-index';
        $form['section[appearanceOrder]'] = 1;
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Paragraphes');
    }

    public function testEditSection()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/section/{id}/edit');

        $form = $crawler->selectButton('Mettre à jour')->form();
        $form['section[name]'] = 'wxy';
        $form['section[pageSlug]'] = 'associaion-adhésion';
        $form['section[appearanceOrder]'] = 2;
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Paragraphes');
    }

    public function testDeleteSection()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/section/{id}');

        $form = $crawler->selectButton('Supprimer')->form();
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Paragraphes');
    }
}

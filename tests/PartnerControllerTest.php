<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PartnerControllerTest extends WebTestCase
{
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

    public function testEditPartners()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/partners/{id}/edit');

        $form = $crawler->selectButton('Mettre à jour')->form();
        $form['partners[name]'] = 'xxx';
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Partenaires');
    }

    public function testDeletePartners()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/partners/{id}');

        $form = $crawler->selectButton('Supprimer')->form();
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Partenaires');
    }
}

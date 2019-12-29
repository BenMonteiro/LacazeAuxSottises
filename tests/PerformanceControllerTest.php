<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PerformanceControllerTest extends WebTestCase
{
    public function testAddPerformance()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/performance/new');

        $form = $crawler->selectButton('Enregistrer')->form();
        $form['performance[companyName]'] = 238;
        $form['performance[cityShow]'] = 'Orion';
        $form['performance[placeShow]'] = 'Place du marché';
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Représentations');
    }

    public function testEditPerformance()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/performance/{id}/edit');

        $form = $crawler->selectButton('Mettre à jour')->form();
        $form['performance[companyName]'] = 239;
        $form['performance[placeShow]'] = 'Boulevard Victor Hugo';
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Représentations');
    }

    public function testDeletePerformance()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/performance/{id}');

        $form = $crawler->selectButton('Supprimer')->form();
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Représentations');
    }
}

<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TeamControllerTest extends WebTestCase
{
    public function testAddTeam()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/team/new');

        $form = $crawler->selectButton('Enregistrer')->form();
        $form['team[name]'] = 'Michelle';
        $form['team[firstName]'] = 'Martin';
        $form['team[role]'] = 'volunteer';
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'L\'Équipe');
    }

    public function testEditTeam()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/team/{id}/edit');

        $form = $crawler->selectButton('Mettre à jour')->form();
        $form['team[name]'] = 'Michelle';
        $form['team[firstName]'] = 'Chirard';
        $form['team[role]'] = 'gov-body';
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'L\'Équipe');
    }

    public function testDeleteTeam()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/team/{id}');

        $form = $crawler->selectButton('Supprimer')->form();
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'L\'Équipe');
    }
}

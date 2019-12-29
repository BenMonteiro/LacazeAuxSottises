<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CompanyControllerTest extends WebTestCase
{
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
            array('/'),
            array('/accueil'),
            array('/company/'),
            array('/company/inDiffusion'),
            array('/company/inCreation'),
            array('/company/new'),
            array('/company/{id}'),
            array('/company/{id}/edit'),
            array('/event/'),
            array('/event/new'),
            array('/event/{id}'),
            array('/event/{id}/edit'),
            array('/partners/'),
            array('/partners/new'),
            array('/partners/{id}'),
            array('/partners/{id}/edit'),
            array('/performance/'),
            array('/performance/new'),
            array('/performance/{id}'),
            array('/performance/{id}/edit'),
            array('/section/'),
            array('/section/new'),
            array('/section/{id}'),
            array('/section/{id}/edit'),
            array('/section/{pageSlug}'),
            array('/team/'),
            array('/team/new'),
            array('/team/{id}'),
            array('/team/{id}/edit'),
        );
    }

    public function testAddCompany()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/company/new');

        $form = $crawler->selectButton('Enregistrer')->form();
        $form['company[name]'] = 'x';
        $form['company[duration]'] = 20;
        $form['company[audience]'] = 'Tout Public';
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Compagnies');
    }

    public function testEditCompany()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/company/{id}/edit');

        $form = $crawler->selectButton('Mettre à jour')->form();
        $form['company[name]'] = 'xxx';
        $form['company[duration]'] = 50;
        $form['company[audience]'] = 'Tout Public';
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Compagnies');
    }

    public function testDeleteCompany()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/company/{id}');

        $form = $crawler->selectButton('Supprimer')->form();
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Compagnies');
    }
}

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
            array('/company/238'),
            array('/company/238/edit'),
            array('/event/'),
            array('/event/new'),
            array('/event/171'),
            array('/event/171/edit'),
            array('/partners/'),
            array('/partners/new'),
            array('/partners/298'),
            array('/partners/298/edit'),
            array('/performance/'),
            array('/performance/new'),
            array('/performance/211'),
            array('/performance/211/edit'),
            array('/section/'),
            array('/section/new'),
            array('/section/196'),
            array('/section/196/edit'),
            array('/section/association-index'),
            array('/team/'),
            array('/team/new'),
            array('/team/79'),
            array('/team/79/edit'),
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

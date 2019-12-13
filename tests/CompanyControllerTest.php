<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CompanyControllerTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/company/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Liste Des Compagnies');
    }
}

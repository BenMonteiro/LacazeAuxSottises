<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Company;

class CompanyControllerTest extends WebTestCase
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
     * @dataProvider provideCompanyUrls
     */
    public function testPageIsSuccessful($url)
    {
        $client = static::createClient();
        $client->request('GET', $url);

        echo $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function provideCompanyUrls()
    {
        return array(
            array('/'),
            array('/accueil'),
            array('/company/'),
            array('/company/inDiffusion'),
            array('/company/inCreation'),
            array('/company/new'),
            array('/company/478'),
            array('/company/478/edit'),
            array('/team/'),
            array('/team/new'),
            array('/team/257/edit'),
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

        $company = $this->entityManager
            ->getRepository(Company::class)
            ->findOneBy(['name' => 'x']);

        $this->assertSame('x', $company->getName());

        return $companyId = $company->getId();
    }

    /**
     * @depends testAddCompany
     */
    public function testEditCompany($companyId)
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/company/' . $companyId . '/edit');

        $form = $crawler->selectButton('Mettre à jour')->form();
        $form['company[name]'] = 'xxx';
        $form['company[duration]'] = 50;
        $form['company[audience]'] = 'Tout Public';
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Compagnies');

        $company = $this->entityManager
            ->getRepository(Company::class)
            ->findOneBy(['name' => 'xxx']);

        $this->assertSame('xxx', $company->getName());

        return $companyId = $company->getId();
    }

    /**
     * @depends testEditCompany
     */
    public function testDeleteCompany($companyId)
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/company/' . $companyId);

        $form = $crawler->selectButton('Supprimer')->form();
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Compagnies');
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}

<?php

namespace App\Tests;

use App\Entity\Company;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CompanyControllerTest extends WebTestCase
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;
    private $client;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    protected function dbConnect()
    {
        $this->client = static::createClient(
            [],
            [
                'PHP_AUTH_USER' => 'test',
                'PHP_AUTH_PW' => 'test2020',
            ]
        );
    }

    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $this->dbConnect();
        $this->client->request('GET', $url);

        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function urlProvider()
    {
        $this->setUp();

        $company = $this->entityManager
            ->getRepository(Company::class)
            ->findOneBy([]);

        $id = $company->getId();

        yield ['/login'];
        yield ['/admin/page/112'];
        yield ['/admin/dashboard'];
        yield ['/'];
        yield ['/company/' . $id];
        yield ['/admin/company/'];
        yield ['/admin/company/new'];
        yield ['/admin/company/' . $id];
        yield ['/admin/company/' . $id . '/edit'];
    }

    /**
     * @dataProvider provideAddCompanyData
     */
    public function testAddCompany($entry, $formDatas)
    {
        $this->dbConnect();

        $crawler = $this->client->request('GET', '/admin/company/new');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('Enregistrer')->form($formDatas);
        $crawler = $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Compagnies');

        $this->assertSelectorTextContains('table', $entry);
    }

    /**
     * @dataProvider provideEditCompanyData
     */
    public function testEditCompany($entry, $formDatas)
    {

        $company = $this->entityManager
            ->getRepository(Company::class)
            ->findOneBy(['name' => 'Jack']);

        $this->assertSame('Jack', $company->getName());

        $companyId = $company->getId();

        $this->dbConnect();

        $crawler = $this->client->request('GET', '/admin/company/' . $companyId . '/edit');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('Mettre à jour')->form($formDatas);
        $crawler = $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Compagnies');

        $this->assertSelectorTextNotContains('table', $company->getName());

        $this->assertSelectorTextContains('table', $entry);
    }

    public function testDeleteCompany()
    {
        $company = $this->entityManager
            ->getRepository(Company::class)
            ->findOneBy(['name' => 'Chirard']);

        $this->assertSame('Chirard', $company->getName());

        $companyId = $company->getId();

        $this->dbConnect();

        $crawler = $this->client->request('GET', '/admin/company/' . $companyId . '/edit');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('Supprimer')->form();
        $crawler = $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Compagnies');

        $this->assertSelectorTextNotContains('table', $company->getName());
    }

    public function provideAddCompanyData()
    {
        return [
            'add' => [
                'Jack',
                'company' =>
                [
                    'company[name]' => 'Jack',
                    'company[duration]' => 20,
                    'company[audience]' => 'Tout Public'
                ]
            ],
        ];
    }

    public function provideEditCompanyData()
    {
        return [
            'edit' => [
                'Chirard',
                'company' =>
                [
                    'company[name]' => 'Chirard',
                    'company[duration]' => 80,
                    'company[audience]' => 'Tout Public'
                ]
            ],
        ];
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}

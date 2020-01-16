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

    public function AddCompany()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/company/new');

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
     * @depends AddCompany
     */
    public function EditCompany($companyId)
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/company/' . $companyId . '/edit');

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
     * @depends EditCompany
     */
    public function testDeleteCompany($companyId)
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/company/' . $companyId);

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

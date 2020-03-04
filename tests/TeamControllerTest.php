<?php

namespace App\Tests;

use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TeamControllerTest extends WebTestCase
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
                'PHP_AUTH_USER' => 'lacaze_admin',
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

        $team = $this->entityManager
            ->getRepository(Team::class)
            ->findOneBy([]);

        $id = $team->getId();

        yield ['/admin/team/'];
        yield ['/admin/team/new'];
        yield ['/admin/team/' . $id . '/edit'];
    }

    /**
     * @dataProvider provideAddTeamData
     */
    public function testAddTeam($entry, $formDatas)
    {
        $this->dbConnect();

        $crawler = $this->client->request('GET', '/admin/team/new');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('Enregistrer')->form($formDatas);
        $crawler = $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSelectorTextContains('h1', 'L\'Équipe');

        $this->assertSelectorTextContains('table', $entry);
    }

    /**
     * @dataProvider provideEditTeamData
     */
    public function testEditTeam($entry, $formDatas)
    {

        $team = $this->entityManager
            ->getRepository(Team::class)
            ->findOneBy(['firstName' => 'Martin']);

        $this->assertSame('Martin', $team->getFirstName());

        $teamId = $team->getId();

        $this->dbConnect();

        $crawler = $this->client->request('GET', '/admin/team/' . $teamId . '/edit');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('Mettre à jour')->form($formDatas);
        $crawler = $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSelectorTextContains('h1', 'L\'Équipe');


        $this->assertSelectorTextNotContains('table', $team->getFirstName());

        $this->assertSelectorTextContains('table', $entry);
    }

    public function testDeleteTeam()
    {
        $team = $this->entityManager
            ->getRepository(Team::class)
            ->findOneBy(['firstName' => 'Chirard']);

        $this->assertSame('Chirard', $team->getFirstName());

        $teamId = $team->getId();

        $this->dbConnect();

        $crawler = $this->client->request('GET', '/admin/team/' . $teamId . '/edit');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('Supprimer')->form();
        $crawler = $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSelectorTextContains('h1', 'L\'Équipe');

        $this->assertSelectorTextNotContains('table', $team->getFirstName());
    }

    public function provideAddTeamData()
    {
        return [
            'add' => [
                'Martin',
                'team' =>
                [
                    'team[name]' => 'Michelle',
                    'team[firstName]' => 'Martin',
                    'team[role]' => 'volunteer'
                ]
            ],
        ];
    }

    public function provideEditTeamData()
    {
        return [
            'edit' => [
                'Chirard',
                'team' => [
                    'team[name]' => 'Gérard',
                    'team[firstName]' => 'Chirard'
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

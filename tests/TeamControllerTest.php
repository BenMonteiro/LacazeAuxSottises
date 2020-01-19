<?php

namespace App\Tests;

use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class TeamControllerTest extends WebTestCase
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
     * @dataProvider provideTeamData
     */
    public function testTeamActions($searchField, $searchedValue, $button, $formDatas, $defaultUrl = 'team_new', $urlParams = [])
    {
        if (null !== $searchField) {
            $team = $this->entityManager
                ->getRepository(Team::class)
                ->findOneBy([$searchField => $searchedValue]);

            $this->assertSame($searchedValue, $team->getFirstName());

            $teamId = $team->getId();
            $defaultUrl = 'team_edit';
            $urlParams = ['id' => $teamId];
        }

        $client = static::createClient(
            [],
            [
                'PHP_AUTH_USER' => 'test',
                'PHP_AUTH_PW' => 'test2020',
            ]
        );

        $crawler = $client->request('GET', $defaultUrl, $urlParams);

        $this->assertTrue($client->getResponse()->isSuccessful());

        $form = $crawler->selectButton($button)->form($formDatas);
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'L\'Équipe');
    }

    public function provideTeamData()
    {
        return [
            'add' => [null, null, 'Enregistrer', 'team' => ['team[name]' => 'Michelle', 'team[firstName]' => 'Martin', 'team[role]' => 'volunteer']],
            'edit' => ['firstName', 'Martin', 'Mettre à jour', 'team' => ['team[name]' => 'Gérard', 'team[firstName]' => 'Chirard', 'team[role]' => 'gov_body']],
            'delete' => ['firstName', 'Chirard', 'Supprimer', null]
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

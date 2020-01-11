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
    public function testTeamActions($searchField, $searchedValue, $button, $formDatas, $defaultUrl = '/team/new')
    {
        if (null !== $searchField) {
            $team = $this->entityManager
                ->getRepository(Team::class)
                ->findOneBy([$searchField => $searchedValue]);

            $this->assertSame($searchedValue, $team->getFirstName());

            $teamId = $team->getId();
            $defaultUrl = '/team/' . $teamId . '/edit';
        }

        $client = static::createClient();

        $crawler = $client->request('GET', $defaultUrl);

        $form = $crawler->selectButton($button)->form($formDatas);
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'L\'Équipe');
    }

    /***
     * @depends testTeamActions
     */
    public function provideTeamData($teamId)
    {
        return array(
            'add' => array(null, null, 'Enregistrer', 'team' => array('team[name]' => 'Michelle', 'team[firstName]' => 'Martin', 'team[role]' => 'volunteer')),
            'edit' => array('firstName', 'Martin', 'Mettre à jour', 'team' => array('team[name]' => 'Gérard', 'team[firstName]' => 'Chirard', 'team[role]' => 'gov_body')),
            'delete' => array('firstName', 'Chirard', 'Supprimer', null)

        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }

    /**
     * @dataProvider provideTeamUrls
     */
    public function testPageIsSuccessful($url)
    {
        $client = static::createClient();
        $client->request('GET', $url);

        echo $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function provideTeamUrls()
    {
        return array(
            array('/team/'),
            array('/team/new'),
            array('/team/10/edit'),
        );
    }
}

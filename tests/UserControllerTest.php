<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;

class UserControllerTest extends WebTestCase
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
        yield ['/admin/user/'];
        yield ['/admin/add_user'];
    }

    /**
     * @dataProvider provideAddUser
     */
    public function testAddUser($entry, $formDatas)
    {
        $this->dbConnect();

        $crawler = $this->client->request('GET', '/admin/add_user');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('Enregistrer')->form($formDatas);
        $crawler = $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Administrateurs');

        $this->assertSelectorTextContains('table', $entry);
    }

    public function testDeleteUser()
    {
        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['username' => 'testAdd']);

        $this->assertSame('testAdd', $user->getUsername());

        $this->entityManager->remove($user);
        $this->entityManager->flush();

        $this->dbConnect();

        $this->client->request('GET', '/admin/user/');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $this->assertSelectorTextContains('h1', 'Liste Des Administrateurs');

        $this->assertSelectorTextNotContains('table', $user->getUsername());
    }

    public function provideAddUser()
    {
        return [
            'add' => [
                'testAdd',
                'user' =>
                [
                    'registration_form[username]' => 'testAdd',
                    'registration_form[plainPassword]' => 'test2020',
                    'registration_form[roles][0]' => 'ROLE_ADMIN'
                ]
            ],
        ];
    }
}

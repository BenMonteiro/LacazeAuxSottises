<?php

namespace App\Tests;

use App\Entity\PressDocument;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PressDocControllerTest extends WebTestCase
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
        yield ['/admin/press/document/'];
        yield ['/admin/press/document/new'];
    }

    /**
     * @dataProvider provideAddPressDocData
     */
    public function testAddDocument($formDatas)
    {
        $this->dbConnect();

        $crawler = $this->client->request('GET', '/admin/press/document/new');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('Enregistrer')->form($formDatas);
        $crawler = $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Documents');

        $doc = $this->entityManager
            ->getRepository(PressDocument::class)
            ->findOneBy(['name' => 'bleu.pdf']);

        $this->assertSelectorTextContains('body', $doc->getName());
    }

    public function testDeletePressDoc()
    {
        $doc = $this->entityManager
            ->getRepository(PressDocument::class)
            ->findOneBy(['name' => 'bleu.pdf']);
        $this->assertSame('bleu.pdf', $doc->getName());

        $docId = $doc->getId();

        $this->dbConnect();

        $crawler = $this->client->request('GET', '/admin/press/document/');
        $form = $crawler->filter('.delete-form-' . $docId)->form();
        $crawler = $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Liste Des Documents');

        $this->assertSelectorTextNotContains('body', $doc->getName());
    }

    public function provideAddPressDocData()
    {
        return [
            'add' => [
                'press_document' =>
                [
                    'press_document[name]' => 'bleu.pdf',
                    'press_document[fileType]' => 'file',
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

<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Entity\Data;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DataControllerTest
 *
 * @package AppBundle\Tests\Controller
 */
class DataControllerTest extends KernelTestCase
{
    /**
     * @var \appTestDebugProjectContainer
     */
    private $container;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * SetUP
     */
    public function setUp()
    {
        $kernel = static::bootKernel();

        $this->container = $kernel->getContainer();
        $this->client = $this->container->get('test.client');
        $this->entityManager = $this->container->get('doctrine.orm.entity_manager');
    }

    /**
     * Test index page
     */
    public function testIndex()
    {
        $this->client->request('GET', '/');

        $this->assertEquals(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode());
    }

    /**
     * Test list responses
     */
    public function testGet()
    {
        $this->client->request('GET', '/getRequest');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        $json = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertTrue($json['Success']);
        $this->assertTrue(is_array($json['Data']));
    }

    /**
     * Create data item
     *
     * @dataProvider getRequestData
     *
     * @param $method
     * @param $content
     */
    public function testNew($method, $content)
    {
        $route = time();

        $this->client->request($method, '/storeRequest/'.$route, [], [], [], $content);

        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());

        $json = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertTrue($json['Success']);
        $this->assertTrue($json['id'] > 0);

        /** @var Data $item */
        $item = $this->entityManager
            ->getRepository('AppBundle:Data')
            ->find($json['id']);

        $this->assertNotEmpty($item);
        $this->assertEquals($item->getRoute(), $route);

        if ('POST' == $method && $content) {
            $this->assertEquals($item->getBody(), $content);
        }
    }

    /**
     * Get request data
     *
     * @return array
     */
    public function getRequestData()
    {
        return [
            'POST' => [
                'method'  => 'POST',
                'content' => 'Test Content',
            ],
            'GET'  => [
                'method'  => 'GET',
                'content' => null,
            ],
        ];
    }
}

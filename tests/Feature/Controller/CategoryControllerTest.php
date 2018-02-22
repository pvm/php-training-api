<?php

namespace App\Tests\Feature\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * @coversDefaultClass \App\Controller\CategoryController
 */
class CategoryControllerTest extends WebTestCase
{
    public $client;

    public function setUp()
    {
        $this->client = static::createClient();
        parent::setUp();
    }

    public function testIndex()
    {
        $this->client->request('GET', '/api/categories');
        $response = $this->client->getResponse();

        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
        $this->assertEquals("[]", $response->getContent());
    }

    public function testShowWhenCategoryNotExists()
    {
        $this->client->request('GET', '/api/categories/999');
        $response = $this->client->getResponse();
        $expected = '{"code":0,"message":"Category not found."}';

        $this->assertSame(Response::HTTP_NOT_FOUND, $response->getStatusCode());
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
        $this->assertEquals($expected, $response->getContent());
    }
}

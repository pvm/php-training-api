<?php

namespace App\Tests\Feature\Controller;

use App\Tests\ApiTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * @coversDefaultClass \App\Controller\CategoryController
 */
class CategoryControllerTest extends ApiTestCase
{
    /**
     * @var \Symfony\Bundle\FrameworkBundle\Client
     */
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

    public function testShowNonexistentCategory()
    {
        $this->client->request('GET', '/api/categories/999');
        $response = $this->client->getResponse();
        $expected = '{"code":0,"message":"Category not found."}';

        $this->assertSame(Response::HTTP_NOT_FOUND, $response->getStatusCode());
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
        $this->assertEquals($expected, $response->getContent());
    }

    public function testCreateCategoryWithValidData()
    {
        $data = [
            'name' => 'Category 1',
            'description' => 'Description of category 1.'
        ];
        $expected = json_encode(array_merge(['id' => 1], $data));

        $this->client->request('POST', '/api/categories', $data);
        $response = $this->client->getResponse();

        $this->assertSame(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
        $this->assertEquals($expected, $response->getContent());
    }
}

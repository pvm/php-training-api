<?php

namespace App\Tests\Feature\Controller;

use App\Tests\ApiTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * @coversDefaultClass \App\Controller\CategoryController
 */
class CategoryControllerTest extends ApiTestCase
{
    public function testListCategories()
    {
        $this->client->request('GET', '/api/categories');
        $response = $this->client->getResponse();
        $expected = [
            [
                'id' => 1,
                'name' => 'PHP Syntax',
                'description' => 'PHP Syntax Description'
            ]
        ];

        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
        $this->assertEquals(json_encode($expected), $response->getContent());
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

    public function testShowExistentCategory()
    {
        $this->client->request('GET', '/api/categories/1');
        $response = $this->client->getResponse();
        $expected = [
            'id' => 1,
            'name' => 'PHP Syntax',
            'description' => 'PHP Syntax Description'
        ];

        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
        $this->assertEquals(json_encode($expected), $response->getContent());
    }

    public function testCreateCategoryWithValidData()
    {
        $data = [
            'name' => 'Category 1',
            'description' => 'Description of category 1.'
        ];
        $expected = json_encode(array_merge(['id' => 2], $data));

        $this->client->request('POST', '/api/categories', $data);
        $response = $this->client->getResponse();

        $this->assertSame(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
        $this->assertEquals($expected, $response->getContent());
    }

    public function testUpdateCategoryWithValidData()
    {
        $data = [
            'name' => 'Category 1 Updated',
            'description' => 'Description of category 1. Updated'
        ];
        $expected = json_encode(array_merge(['id' => 1], $data));

        $this->client->request('PUT', '/api/categories/1', $data);
        $response = $this->client->getResponse();

        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
        $this->assertEquals($expected, $response->getContent());
    }
    public function testUpdateNonexistentCategoryWithValidData()
    {
        $data = [
            'name' => 'Category 1 Updated',
            'description' => 'Description of category 1. Updated'
        ];
        $expected = '{"code":0,"message":"Category not found."}';

        $this->client->request('PUT', '/api/categories/999', $data);
        $response = $this->client->getResponse();

        $this->assertSame(Response::HTTP_NOT_FOUND, $response->getStatusCode());
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
        $this->assertEquals($expected, $response->getContent());
    }

    public function testDeleteExistentCategory()
    {
        $this->client->request('DELETE', '/api/categories/1');
        $response = $this->client->getResponse();

        $this->assertSame(Response::HTTP_NO_CONTENT, $response->getStatusCode());
        $this->assertFalse($response->headers->contains('Content-Type', 'application/json'));
        $this->assertEquals('', $response->getContent());
    }

    public function testDeleteNonexistentCategory()
    {
        $this->client->request('DELETE', '/api/categories/999');
        $response = $this->client->getResponse();
        $expected = '{"code":0,"message":"Category not found."}';

        $this->assertSame(Response::HTTP_NOT_FOUND, $response->getStatusCode());
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
        $this->assertEquals($expected, $response->getContent());
    }
}

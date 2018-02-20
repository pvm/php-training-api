<?php

namespace App\Tests\Feature\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @coversDefaultClass \App\Controller\CategoryController
 */
class CategoryControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/api/categories');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testShow()
    {
        $client = static::createClient();
        $client->request('GET', '/api/categories/1');

        $this->assertSame(404, $client->getResponse()->getStatusCode());
    }
}

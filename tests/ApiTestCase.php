<?php

namespace App\Tests;

use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiTestCase extends WebTestCase
{
    private $client;

    public function setUp()
    {
        parent::setUp();
        $this->purgeDatabase();
    }

    private function purgeDatabase()
    {
        $entityManager = $this->getService('doctrine')->getManager();

        $purger = new ORMPurger($entityManager);
        $purger->purge();
    }

    private function getService($id)
    {
        return self::$kernel->getContainer()->get($id);
    }
}
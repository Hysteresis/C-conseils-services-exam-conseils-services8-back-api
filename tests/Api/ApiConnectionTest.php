<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ApiConnectionTest extends WebTestCase
{

    private ?KernelBrowser $client;

    public function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testApiConnection(): void
    {

    }
}
<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdsControllerTest extends WebTestCase
{
    public function testAds(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/offres-d-emploi/437');
        $crawler->filter('html:contains("Candidater à l\'offre")');

        $this->assertResponseIsSuccessful();
        // $this->assertSelectorTextContains('a', 'Candidater à l\'offre');
    }
}

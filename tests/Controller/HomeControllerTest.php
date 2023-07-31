<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class HomeControllerTest extends WebTestCase
{

    private ?KernelBrowser $client;

    public function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testHomePage(): void
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('p', 'Notre travail est de vous en trouver');
    }

    //!TEST FOnctionnel

    /**
     * @group testRegister
     */
    public function testRegisterPage(): void
    {

        $crawler = $this->client->request('GET', '/register/candidate');

        $form = $crawler->selectButton('S\'enregistrer')->form();
        $form['candidate_registration_form[lastname]'] = 'Jules';
        $form['candidate_registration_form[firstname]'] = 'Sanchez';
        $form['candidate_registration_form[email]'] = 'jules.sanchez@live.com';
        $form['candidate_registration_form[plainPassword]'] = '$2y$04$16w1hC2GjKMg/yk6B2kHouvNn97nqPNg/jcKzwDBsyEfq26HhYnw6';
        $form['candidate_registration_form[agreeTerms]'] = true;

        $this->client->submit($form);
        $this->assertResponseIsSuccessful();

    }

    //!TEST FOnctionnel scenario utilisateur
    public function testUserStory(): void
    {

        $crawler = $this->client->request('GET', '/');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('p', 'Notre travail est de vous en trouver');


        $link1 = $crawler->selectLink('Toutes les annonces')->link();
        $crawler = $this->client->click($link1);
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $link2 = $crawler->selectLink('S\'inscrire')->link();;
        $crawler = $this->client->click($link2);
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
    
}

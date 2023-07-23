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
        // $this->userRepository = $this->client->getContainer()->get('doctrine.orm.entity_manager')->getRepository(User::class);
        // $this->user = $this->userRepository->findOneByEmail('john.doe@mail.fr');
        // $this->client->loginUser($this->user);

    }

    public function testHomePage(): void
    {
        // $client = static::createClient();
        $crawler = $this->client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('label', 'Choisissez une ville');
    }

    //!TEST FOnctionnel
    public function testRegisterPage(): void
    {

        $crawler = $this->client->request('GET', '/register/candidate');

        $form = $crawler->selectButton('S\'enregistrer')->form();
        $form['candidate_registration_form[lastname]'] = 'Breton';
        $form['candidate_registration_form[firstname]'] = 'Andrée';
        $form['candidate_registration_form[email]'] = 'descamps.guy@sfr.fr';
        // TODO MDP ne fonctionne pas
        // $form['registration_form[plainPassword]'] = '$2y$13$7k3NZD3c0h50JisrzezX6epKgSpA1AIF7rGgScired4bDey316Db6';
        $form['candidate_registration_form[agreeTerms]'] = true;

        $this->client->submit($form);
        // $this->client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('a', 'Home');

    }

    //!TEST FOnctionnel scenario utilisateur
    public function testUserStory(): void
    {
        if ($this->client === null) {
            throw new \Exception('The client is not initialized.');
        }
        // Un utilisateur arrive sur la page d'accueil
        $crawler = $this->client->request('GET', '/');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('label', 'Choisissez une ville');
        // dump($crawler);

        // il va ensuite sur la page des annonces 
        $link1 = $crawler->selectLink('Toutes les annonces')->link();
        // $crawler = $this->client->click($link1);
        // $this->client->click($link1);
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('label', 'Choisissez une ville');

        // il doit passer par le lien de login pour s'enregistrer
        $link2 = $crawler->selectLink('Se connecter')->link();
        $crawler = $this->client->click($link2);

        // il se créer un compte 
        $crawler = $this->client->request('GET', '/register/candidate');
        $form = $crawler->selectButton('S\'enregistrer')->form();
        $form['candidate_registration_form[lastname]'] = 'Breton';
        $form['candidate_registration_form[firstname]'] = 'Andrée';
        $form['candidate_registration_form[email]'] = 'descamps.guy@sfr.fr';
        $form['candidate_registration_form[agreeTerms]'] = true;
        $this->client->submit($form);
        // $this->client->followRedirect();
        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('a', 'Home');

    }
    
}

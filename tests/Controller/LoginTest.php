<?php
 
namespace App\Tests\Controller;
 
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
 
class LoginTest extends WebTestCase
{
    private $client;
 
    protected function setUp():void
    {
        parent::setUp();
        //Créer le client
        $this->client = static::createClient();
    }
    public function testLoginPageIsRender()
    {
        $this->client->request('GET', '/login');
        $this->assertResponseIsSuccessful(); // Vérifier qu'elle est en succès
        $this->assertSelectorTextContains('h1', 'Connexion'); // Vérifier que la page contient bien le titre
    }
 
    public function testSuccessfulLogin()
    {
       // Faire la requête
       $crawler = $this->client->request('GET', '/login');
       // Soumettre le formulaire
       $form = $crawler->selectButton('login')->form([
        '_username' => 'test@test.com',
        '_password' => 'testtest',
        ]);
        $this->client->submit($form);
       // vérifier qu'on est bien redirigé vers la page d'accueil
       $this->assertResponseRedirects();
        $location = $this->client->getResponse()->headers->get('Location');
        $this->assertStringEndsWith('/home', $location);

        // Suivre la redirection
        $crawler = $this->client->followRedirect();
        // vérifier que la page d'accueil contient bien les bons textes
        $this->assertSelectorTextContains('p', 'Vous êtes connecté');
    }
 
    public function testWrongLogin()
    {
       // Faire la requête
       $crawler = $this->client->request('GET', '/login');
       // Soumettre le formulaire
       $form = $crawler->selectButton('login')->form([
        '_username' => 'test@test.com',
        '_password' => 'testtests',
        ]);
        $this->client->submit($form);
        $this->assertResponseRedirects();
        $location = $this->client->getResponse()->headers->get('Location');
        $this->assertStringEndsWith('/login', $location);
        $crawler = $this->client->followRedirect();
        $this->assertSelectorTextContains('div', "Invalid credentials.");
    }
 
}
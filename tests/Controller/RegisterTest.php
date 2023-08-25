<?php
 
namespace App\Tests\Controller;
 
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
 
class RegisterTest extends WebTestCase
{
    private $client;
    private $entityManager;
    protected function setUp():void
    {
        parent::setUp();

        // Créer le client
        $this->client = static::createClient();

        // Créer l'entity manager
        $this->entityManager = $this->client->getContainer()->get('doctrine')->getManager();
    }
    public function testRenderRegisterPage()
    {
        $crawler = $this->client->request('GET', '/register');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Register');
    }
 
    public function testSuccessfulRegister()
    {
        // Faire la requête
        $crawler = $this->client->request('GET', '/register');
       
       // Soumettre le formulaire
        $form = $crawler->selectButton("Register")->form([
            'registration_form[email]' => 'teste@test.com',
            'registration_form[lastname]' => 'test',
            'registration_form[firstName]' => 'test',
            'registration_form[plainPassword]' => 'testtest',
        ]);
        $this->client->submit($form);

       // vérifier qu'on est bien redirigé vers le login
        $this->assertResponseRedirects();
        $location = $this->client->getResponse()->headers->get('Location');
        $this->assertStringEndsWith('/login', $location);
        $crawler = $this->client->followRedirect();
        $this->assertSelectorTextContains('h1', "Connexion");
        
       // Vérifier qu'on retrouve bien l'utilisateur en BDD
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => 'teste@test.com']);
        $this->assertInstanceOf(User::class, $user);
    }
 
    protected function tearDown():void{
        parent::tearDown();

        // Supprimer l'utilisateur créé en BDD
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => 'teste@test.com']);
        if ($user) {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
        }

        // Remettre le client et l'entity manager à null
        $this->client = null;
        $this->entityManager = null;
    }
}
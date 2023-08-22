<?php

namespace App\Tests\Entity;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    public function testCreateUser()
    {
        $user = new User();
        $user->setLastName('math');
        $user->setFirstName('math');
        $user->setEmail('math@example.com');
        $user->setPassword('math');
        $user->setRoles(['ROLE_USER']);

        $this->assertEquals('math', $user->getLastName());
        $this->assertEquals('math', $user->getFirstName());
        $this->assertEquals('math@example.com', $user->getEmail());
        $this->assertEquals('math', $user->getPassword());
        $this->assertContains('ROLE_USER', $user->getRoles());
        $this->assertEquals('math@example.com', $user->getUserIdentifier());
    }
}
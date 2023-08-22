<?php

namespace App\Tests\Entity;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    public function testCreateUser()
    {
        $user = new User();
        $user->setLastName('bryan');
        $user->setFirstName('tremel');
        $user->setEmail('bryan@example.com');
        $user->setPassword('password');
        $user->setRoles(['ROLE_USER']);

        $this->assertEquals('bryan', $user->getLastName());
        $this->assertEquals('tremel', $user->getFirstName());
        $this->assertEquals('bryan@example.com', $user->getEmail());
        $this->assertEquals('password', $user->getPassword());
        $this->assertContains('ROLE_USER', $user->getRoles());
        $this->assertEquals('bryan@example.com', $user->getUserIdentifier());
    }
}
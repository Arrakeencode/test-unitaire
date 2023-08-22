<?php

namespace App\Tests\Entity;

use App\Entity\Order;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OrderTest extends KernelTestCase
{
    public function testCreateOrder()
    {
        $user = new User();
        $order = new Order();
        $order->setNumber('12');
        $order->setTotalPrice(10);
        $user->setEmail('bryan@example.com');

        $this->assertEquals('12', $order->getNumber());
        $this->assertEquals(10, $order->getTotalPrice());
        $this->assertEquals('bryan@example.com', $user->getUserIdentifier());
    }
}
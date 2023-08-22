<?php

namespace App\Tests\Entity;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductTest extends KernelTestCase
{
    public function testProduct()
    {
        $product = new Product();
        $product->setName('assiete');
        $product->setPrice(10);

        $this->assertEquals('assiete', $product->getName());

        $this->assertEquals(10, $product->getPrice());
    }
}

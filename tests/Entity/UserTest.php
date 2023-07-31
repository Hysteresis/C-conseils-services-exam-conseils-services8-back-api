<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @group testRegister
     */
    public function testGettersAndSetters(): void
    {
        $user = new User();
        
        $this->assertNull($user->getId());
        
        $user->setEmail('test@example.com');
        $this->assertEquals('test@example.com', $user->getEmail());

        $user->setFirstname('John');
        $this->assertEquals('John', $user->getFirstname());

        $user->setLastname('Doe');
        $this->assertEquals('Doe', $user->getLastname());

        $user->setAlias('johnd');
        $this->assertEquals('johnd', $user->getAlias());

        $user->setPassword('secret');
        $this->assertEquals('secret', $user->getPassword());

        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $this->assertEquals(['ROLE_USER', 'ROLE_ADMIN'], $user->getRoles());

        $user->setIsVerified(true);
        $this->assertTrue($user->isVerified());

        $user->setPhoneNumber('1234567890');
        $this->assertEquals('1234567890', $user->getPhoneNumber());
    }
}

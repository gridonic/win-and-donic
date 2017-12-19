<?php

/*
 * This file is part of the win-and-donic sample project.
 *
 * Copyright (c) Gridonic AG <hello@gridonic.ch>
 */

namespace App\Tests\Unit\Traits;

use App\Entity\User;
use App\Test\Unit\UnitTestBaseTrait;
use App\Test\Unit\UnitTestEnityManagerTrait;
use Doctrine\ORM\EntityRepository;
use PHPUnit_Framework_MockObject_MockObject;

trait TestUsersTrait
{
    use UnitTestEnityManagerTrait;
    use UnitTestBaseTrait;

    private $userRepository;
    private $defaultUsers;

    protected function getDefaultUsers()
    {
        if ($this->defaultUsers === null) {
            $this->defaultUsers = array(
                'bidu' => $this->createUser('bidu'),
                'julez' => $this->createUser('julez'),
                'peschee' => $this->createUser('peschee'),
            );

        }

        return $this->defaultUsers;
    }

    /**
     * @param string $username
     *
     * @return User
     */
    protected function createUser(string $username)
    {
        $user = new User();
        $user->setId($this->nextEntityId(User::class));
        $user->setUsername($username);

        return $this->getEntityService()
            ->persistEntity($user);
    }

    /**
     * @return EntityRepository|PHPUnit_Framework_MockObject_MockObject
     */
    protected function getUserRepository()
    {
        if ($this->userRepository === null) {
            $this->userRepository = $this->createUserRepository();
        }

        return $this->userRepository;
    }

    /**
     * @return EntityRepository|PHPUnit_Framework_MockObject_MockObject
     */
    private function createUserRepository()
    {
        return $this->useRepository(User::class);
    }
}

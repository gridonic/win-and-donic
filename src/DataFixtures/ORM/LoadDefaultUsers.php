<?php

/*
 * This file is part of the win-and-donic sample project.
 *
 * Copyright (c) Gridonic AG <hello@gridonic.ch>
 */

namespace App\DataFixtures\ORM;


use App\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDefaultUsers extends AbstractFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->createUser($manager, 'bidu');
        $this->createUser($manager, 'julez');
        $this->createUser($manager, 'peschee');

        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @param string $name
     *
     * @return User
     */
    protected function createUser(ObjectManager $manager, $name): User
    {
        $user = new User();

        $user->setUsername($name);
        $user->setEmail("{$name}@gridonic.ch");

        $this->setReference("user-$name", $user);

        $manager->persist($user);

        return $user;
    }
}

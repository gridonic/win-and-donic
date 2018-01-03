<?php

/*
 * This file is part of the win-and-donic sample project.
 *
 * Copyright (c) Gridonic AG <hello@gridonic.ch>
 */

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Represents a single player that can participate in games.
 *
 * @ORM\Entity(repositoryClass="App\Repository\PlayerRepository")
 */
class Player extends GameParticipant
{
    /**
     * @var User
     *
     * @ORM\OneToOne(targetEntity="App\Entity\User")
     */
    private $user;

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        if (empty($this->getUser())) {
            return null;
        }

        return $this->getUser()->getUsername();
    }
}

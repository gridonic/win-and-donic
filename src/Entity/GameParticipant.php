<?php

/*
 * This file is part of the win-and-donic sample project.
 *
 * Copyright (c) Gridonic AG <hello@gridonic.ch>
 */

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Base class for participants of a game. For each type of participant (e.g., Single Player, Team), a new Entity inheriting
 * from this class must be created. Note that it must be included in the DiscriminatorMap in the annotation below.
 *
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"player" = "Player", "team" = "Team"})
 */
abstract class GameParticipant
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

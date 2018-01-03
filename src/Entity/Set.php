<?php

/*
 * This file is part of the win-and-donic sample project.
 *
 * Copyright (c) Gridonic AG <hello@gridonic.ch>
 */

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="single_set")
 * @ORM\Entity()
 */
class Set
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
     * @var Game
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Game", inversedBy="sets")
     */
    private $game;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $setIndex;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $homeScore;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $awayScore;

    /**
     * @return Game
     */
    public function getGame(): ?Game
    {
        return $this->game;
    }

    /**
     * @param Game $game
     *
     * @return $this
     */
    public function setGame(Game $game)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getSetIndex(): ?int
    {
        return $this->setIndex;
    }

    /**
     * @param int $setIndex
     *
     * @return $this
     */
    public function setSetIndex(int $setIndex)
    {
        $this->setIndex = $setIndex;

        return $this;
    }

    /**
     * @return int
     */
    public function getHomeScore(): ?int
    {
        return $this->homeScore;
    }

    /**
     * @param int $homeScore
     *
     * @return $this
     */
    public function setHomeScore(int $homeScore)
    {
        $this->homeScore = $homeScore;

        return $this;
    }

    /**
     * @return int
     */
    public function getAwayScore(): ?int
    {
        return $this->awayScore;
    }

    /**
     * @param int $awayScore
     *
     * @return $this
     */
    public function setAwayScore(int $awayScore)
    {
        $this->awayScore = $awayScore;

        return $this;
    }
}

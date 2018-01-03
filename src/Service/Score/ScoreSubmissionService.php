<?php

/*
 * This file is part of the win-and-donic sample project.
 *
 * Copyright (c) Gridonic AG <hello@gridonic.ch>
 */

namespace App\Service\Score;

use App\Entity\Game;
use App\Entity\GameParticipant;
use App\Entity\Set;
use App\Repository\GameRepository;
use App\Service\Core\EntityService;
use Doctrine\ORM\EntityRepository;

class ScoreSubmissionService
{
    /** @var EntityService */
    private $entityService;

    /** @var EntityRepository */
    private $gameRepository;

    /**
     * @param EntityService $entityService
     * @param GameRepository $gameRepository
     */
    public function __construct(EntityService $entityService, GameRepository $gameRepository)
    {
        $this->entityService = $entityService;
        $this->gameRepository = $gameRepository;
    }

    /**
     * @param GameParticipant $homeParticipant
     * @param GameParticipant $awayParticipant
     * @param array $setScores
     *
     * @return Game
     */
    public function submitScore(GameParticipant $homeParticipant, GameParticipant $awayParticipant, array $setScores)
    {
        $game = new Game();

        $this
            ->setParticipantsInGame($game, $homeParticipant, $awayParticipant)
            ->createAndAddSetsToGame($game, $setScores)
            ->persistGame($game);

        return $game;
    }

    /**
     * @param Game $game
     * @param GameParticipant $homeParticipant
     * @param GameParticipant $awayParticipant
     *
     * @return $this
     */
    private function setParticipantsInGame(Game $game, GameParticipant $homeParticipant, GameParticipant $awayParticipant)
    {
        $game->setHomeParticipant($homeParticipant);
        $game->setAwayParticipant($awayParticipant);

        return $this;
    }

    /**
     * @param Game $game
     * @param array $setScores
     *
     * @return $this
     */
    private function createAndAddSetsToGame(Game $game, array $setScores)
    {
        foreach ($setScores as $setScore) {
            $set = $this->createSet($setScore);
            $game->addSet($set);
        }

        return $this;
    }

    /**
     * @param $setScore
     *
     * @return Set
     */
    private function createSet($setScore)
    {
        $set = new Set();

        $set->setHomeScore($setScore[0]);
        $set->setAwayScore($setScore[1]);

        return $set;
    }

    /**
     * @param Game $game
     *
     * @return $this
     */
    private function persistGame(Game $game)
    {
        $this->entityService->persistEntity($game);

        return $this;
    }
}

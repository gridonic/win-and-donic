<?php

/*
 * This file is part of the win-and-donic sample project.
 *
 * Copyright (c) Gridonic AG <hello@gridonic.ch>
 */

namespace App\Service\Participant;


use App\Entity\Player;
use App\Entity\User;
use App\Repository\PlayerRepository;
use App\Service\Core\EntityService;
use Doctrine\ORM\EntityRepository;

/**
 * A game always consists of participants. This handles the participants of the kind "Single Player".
 *
 * @package App\Service\Participant
 */
class SinglePlayerService
{
    /** @var EntityService */
    private $entityService;

    /** @var EntityRepository */
    private $playerRepository;

    /**
     * @param EntityService $entityService
     * @param PlayerRepository $playerRepository
     s*/
    public function __construct(EntityService $entityService, PlayerRepository $playerRepository)
    {
        $this->entityService = $entityService;
        $this->playerRepository = $playerRepository;
    }

    /**
     * @param User $user
     *
     * @return Player|object
     */
    public function getOrCreatePlayer(User $user)
    {
        $player = $this->playerRepository->findOneBy(array('user' => $user->getId()));

        if (empty($player)) {
            $player = new Player();
            $player->setUser($user);

            $player = $this->persistPlayer($player);
        }

        return $player;
    }

    /**
     * @param $player
     *
     * @return Player
     */
    private function persistPlayer($player)
    {
        return $this->entityService->persistEntity($player);
    }
}

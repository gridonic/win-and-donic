<?php

/*
 * This file is part of the win-and-donic sample project.
 *
 * Copyright (c) Gridonic AG <hello@gridonic.ch>
 */

namespace App\Service\Participant;


use App\Entity\Player;
use App\Entity\User;
use App\Service\Core\EntityService;
use Doctrine\ORM\EntityRepository;

/**
 * A match always consists of participants. This handles the participants of the kind "Single Player".
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
     * @param EntityRepository $playerRepository
     */
    public function __construct(EntityService $entityService, EntityRepository $playerRepository)
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

            $player = $this->entityService->persistEntity($player);
        }

        return $player;
    }
}

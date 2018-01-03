<?php

/*
 * This file is part of the win-and-donic sample project.
 *
 * Copyright (c) Gridonic AG <hello@gridonic.ch>
 */

namespace App\Tests\Unit\Participant;


use App\Entity\Player;
use App\Entity\User;
use App\Service\Participant\SinglePlayerService;
use App\Test\UnitTestBase;
use App\Tests\Unit\Traits\TestUsersTrait;
use Doctrine\ORM\EntityRepository;

class SinglePlayerServiceTest extends UnitTestBase
{
    use TestUsersTrait;

    /** @var EntityRepository */
    private $playerRepository;

    /** @var SinglePlayerService */
    private $singlePlayerService;

    protected function setUp()
    {
        $this->playerRepository = $this->useRepository(Player::class);
        $this->singlePlayerService = new SinglePlayerService(
            $this->getEntityService(), $this->playerRepository
        );
    }

    public function testSinglePlayers_NoneRetrievedYet_PlayerRepositoryEmpty()
    {
        $this->assertEmpty($this->playerRepository->findAll());
    }

    /**
     * @dataProvider singlePlayerUsersDataProvider
     *
     * @param User[] $users
     * @param int $expectedPlayerCount
     */
    public function testSinglePlayers_GetOrCreateWithUsers_CorrectPlayerCountInRepository(
        array $users,
        int $expectedPlayerCount
    ) {
        foreach ($users as $user) {
            $this->singlePlayerService->getOrCreatePlayer($user);
        }

        $this->assertCount($expectedPlayerCount, $this->playerRepository->findAll());
    }

    /**
     * @dataProvider singlePlayerUsersDataProvider
     *
     * @param User[] $users
     */
    public function testSinglePlayers_GetOrCreateWithUsers_PlayersConnectedToUsers(
        array $users
    ) {
        foreach ($users as $user) {
            $this->singlePlayerService->getOrCreatePlayer($user);
        }

        /** @var Player[] $players */
        $players = $this->playerRepository->findAll();

        foreach ($users as $user) {
            $this->assertCount(
                1,
                array_filter(
                    $players,
                    function (Player $player) use ($user) {
                        return $user->getUsername() === $player->getName();
                    }
                )
            );
        }
    }

    /**
     * @dataProvider singlePlayerUsersDataProvider
     *
     * @param User[] $users
     * @param int $expectedPlayerCount
     */
    public function testSinglePlayers_GetOrCreateWithExistingUsers_NoDuplicatesInRepository(
        array $users,
        int $expectedPlayerCount
    ) {
        // Add players multiple times, make sure they still just exist once
        for ($index = 0; $index < 3; $index++) {
            foreach ($users as $user) {
                $this->singlePlayerService->getOrCreatePlayer($user);
            }
        }

        $this->assertCount($expectedPlayerCount, $this->playerRepository->findAll());
    }

    public function singlePlayerUsersDataProvider()
    {
        $users = $this->getDefaultUsers();

        return
            array(
                array(
                    array($users['bidu']),
                    1,
                ),
                array(
                    array($users['julez']),
                    1,
                ),
                array(
                    array($users['peschee']),
                    1,
                ),
                array(
                    array($users['bidu'], $users['julez']),
                    2,
                ),
                array(
                    array(
                        $users['bidu'],
                        $users['bidu'],
                        $users['bidu'],
                    ),
                    1,
                ),
                array(
                    $users,
                    3,
                ),
            );
    }
}

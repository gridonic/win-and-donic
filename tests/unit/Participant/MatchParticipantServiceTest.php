<?php

/*
 * This file is part of the win-and-donic sample project.
 *
 * Copyright (c) Gridonic AG <hello@gridonic.ch>
 */

namespace App\Tests\Unit\Participant;


use App\Entity\Player;
use App\Service\Participant\MatchParticipantService;
use App\Test\UnitTestBase;
use App\Tests\Unit\Traits\TestUsersTrait;
use Doctrine\ORM\EntityRepository;

class MatchParticipantServiceTest extends UnitTestBase
{
    use TestUsersTrait;

    /** @var EntityRepository */
    private $playerRepository;

    /** @var MatchParticipantService */
    private $matchParticipantService;

    protected function setUp()
    {
        $this->playerRepository = $this->useRepository(Player::class);
        $this->matchParticipantService = new MatchParticipantService(
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
     * @param array $users
     * @param int $expectedPlayerCount
     */
    public function testSinglePlayers_GetOrCreateWithUsers_PlayersInRepository($users, $expectedPlayerCount)
    {
        foreach ($users as $user) {
            $this->matchParticipantService->getOrCreatePlayer($user);
        }

        $this->assertCount($expectedPlayerCount, $this->playerRepository->findAll());
    }

    public function singlePlayerUsersDataProvider()
    {
        return
            array(
                array(
                    array($this->getDefaultUsers()['bidu']),
                    1,
                ),
                array(
                    array($this->getDefaultUsers()['julez']),
                    1,
                ),
                array(
                    array($this->getDefaultUsers()['peschee']),
                    1,
                ),
                array(
                    array($this->getDefaultUsers()['bidu'], $this->getDefaultUsers()['julez']),
                    2,
                ),
                array(
                    array($this->getDefaultUsers()['bidu'], $this->getDefaultUsers()['bidu'], $this->getDefaultUsers()['bidu']),
                    1,
                ),
                array(
                    $this->getDefaultUsers(),
                    3,
                ),
            );
    }
}

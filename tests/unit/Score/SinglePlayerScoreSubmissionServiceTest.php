<?php

/*
 * This file is part of the win-and-donic sample project.
 *
 * Copyright (c) Gridonic AG <hello@gridonic.ch>
 */

namespace App\Tests\Unit\Score;

use App\Entity\Game;
use App\Entity\Player;
use App\Entity\Team;
use App\Repository\GameRepository;
use App\Repository\PlayerRepository;
use App\Service\Participant\SinglePlayerService;
use App\Service\Score\ScoreSubmissionService;
use App\Test\Mock\DateTimeServiceMock;
use App\Test\UnitTestBase;
use App\Tests\Unit\Traits\TestUsersTrait;
use Doctrine\ORM\EntityRepository;

class SinglePlayerScoreSubmissionServiceTest extends UnitTestBase
{
    use TestUsersTrait;

    /** @var GameRepository */
    private $gameRepository;

    /** @var SinglePlayerService */
    private $singlePlayerService;

    /** @var ScoreSubmissionService */
    private $scoreSubmissionService;

    /** @var Player */
    private $bidu;

    /** @var Player */
    private $julez;

    protected function setUp()
    {
        /** @var PlayerRepository $playerRepository */
        $playerRepository = $this->useRepository(Player::class);
        $this->gameRepository = $this->useRepository(Game::class);

        $this->singlePlayerService = new SinglePlayerService(
            $this->getEntityService(), $playerRepository
        );

        $this->scoreSubmissionService = new ScoreSubmissionService(
            $this->getEntityService(), $this->gameRepository, new DateTimeServiceMock()
        );

        $this->bidu = $this->singlePlayerService->getOrCreatePlayer($this->getDefaultUsers()['bidu']);
        $this->julez = $this->singlePlayerService->getOrCreatePlayer($this->getDefaultUsers()['julez']);
    }

    public function testSinglesMatch_NoScoreSubmittedYet_MatchRepositoryEmpty()
    {
        $this->assertEmpty($this->gameRepository->findAll());
    }

    /**
     * @dataProvider singlesResultsDataProvider
     *
     * @param array $setScores
     */
    public function testSinglesMatch_ScoreSubmitted_MatchContainsParticipants(array $setScores)
    {
        $match = $this->scoreSubmissionService->submitScore(
            $this->bidu,
            $this->julez,
            $setScores);

        $this->assertEquals($this->bidu, $match->getHomeParticipant());
        $this->assertEquals($this->julez, $match->getAwayParticipant());
    }

    /**
     * @dataProvider singlesResultsDataProvider
     *
     * @param array $setScores
     */
    public function testSinglesMatch_ScoreSubmitted_MatchContainsSetsWithScore(array $setScores)
    {
        $match = $this->scoreSubmissionService->submitScore(
            $this->bidu,
            $this->julez,
            $setScores);

        $this->assertEquals(count($setScores), $match->playedSetsCount());

        $sets = $match->getSets();
        for ($setIndex = 0; $setIndex < count($setScores); $setIndex++) {
            $this->assertEquals($sets[$setIndex]->getHomeScore(), $setScores[$setIndex][0]);
            $this->assertEquals($sets[$setIndex]->getAwayScore(), $setScores[$setIndex][1]);
        }
    }

    /**
     * @dataProvider singlesResultsDataProvider
     *
     * @param array $setScores
     */
    public function testSinglesMatch_ScoreSubmitted_SetIndicesSetByIncomingOrder(array $setScores)
    {
        $match = $this->scoreSubmissionService->submitScore(
            $this->bidu,
            $this->julez,
            $setScores);

        $sets = $match->getSets();
        for ($setIndex = 0; $setIndex < count($setScores); $setIndex++) {
            $this->assertEquals($setIndex, $sets[$setIndex]->getSetIndex());
        }
    }

    /**
     * @dataProvider singlesResultsDataProvider
     *
     * @param array $setScores
     */
    public function testSinglesMatch_ScoreSubmitted_MatchSavedInRepository(array $setScores)
    {
        $match = $this->scoreSubmissionService->submitScore(
            $this->bidu,
            $this->julez,
            $setScores);

        $this->assertCount(1, $this->gameRepository->findAll());
        $this->assertEquals($match, $this->gameRepository->findOneBy(array('id' => $match->getId())));
    }

    // TODO: test multiple matches

    /**
     * @return array
     */
    public function singlesResultsDataProvider()
    {
        return array(
            array(
                $this->result(11, 5, 7, 11, 15, 13),
            ),
            array(
                $this->result(11, 8),
            ),
            array(
                $this->result(11, 1, 0, 7, 8, 11, 13, 11, 9, 11),
            ),
            // TODO: test incorrect result (e.g., only five values) throws exception
        );
    }

    /**
     * @return array
     */
    private function result()
    {
        $args = func_get_args();
        $scoreArray = array();

        for ($argIndex = 0; $argIndex < func_num_args(); $argIndex += 2) {
            $scoreArray[] = array($args[$argIndex], $args[$argIndex + 1]);
        }

        return $scoreArray;
    }
}
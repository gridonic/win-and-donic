<?php

/*
 * This file is part of the win-and-donic sample project.
 *
 * Copyright (c) Gridonic AG <hello@gridonic.ch>
 */

namespace App\Tests\Unit\Score;

use App\Entity\Match;
use App\Entity\Player;
use App\Entity\Team;
use App\Service\Score\ScoreSubmissionService;
use App\Test\UnitTestBase;

class ScoreSubmissionServiceTest extends UnitTestBase
{
    private $scoreSubmissionService;

    protected function setUp()
    {
        $this->useRepository(Player::class);
        $this->useRepository(Team::class);
        $this->useRepository(Match::class);
    }

    /**
     * @ _TODO comment in_ dataProvider singlesResultsDataProvider
     */
    public function testSinglesMatch_ScoreSubmitted_SavedInRepositories()
    {
        $service = new ScoreSubmissionService();

//        $service->submitScore();
    }

//    private function singlesResultsDataProvider()
//    {
//        return array(
//            array(),
//        );
//    }
}

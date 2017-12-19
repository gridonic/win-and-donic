<?php

/*
 * This file is part of the win-and-donic sample project.
 *
 * Copyright (c) Gridonic AG <hello@gridonic.ch>
 */

namespace App\Service\Score;

use App\Entity\MatchParticipant;

class ScoreSubmissionService
{
    public function submitScore(
        MatchParticipant $homeParticipant,
        MatchParticipant $awayParticipant,
        int $homeScore,
        int $awayScore
    ) {
    }
}

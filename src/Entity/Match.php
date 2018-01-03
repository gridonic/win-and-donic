<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Match
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
     * @var MatchParticipant
     *
     * @ORM\OneToOne(targetEntity="MatchParticipant")
     */
    private $homeParticipant;

    /**
     * @var MatchParticipant
     *
     * @ORM\OneToOne(targetEntity="MatchParticipant")
     */
    private $awayParticipant;

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
}

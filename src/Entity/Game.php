<?php

namespace App\Entity;


use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game
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
     * @var DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $dateTime;

    /**
     * @var GameParticipant
     *
     * @ORM\ManyToOne(targetEntity="GameParticipant")
     */
    private $homeParticipant;

    /**
     * @var GameParticipant
     *
     * @ORM\ManyToOne(targetEntity="GameParticipant")
     */
    private $awayParticipant;

    /**
     * @var Set[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Set", mappedBy="game", cascade={"persist"})
     */
    private $sets;

    public function __construct()
    {
        $this->sets = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getDateTime(): ?DateTime
    {
        return $this->dateTime;
    }

    /**
     * @param DateTime $dateTime
     *
     * @return $this
     */
    public function setDateTime(?DateTime $dateTime)
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * @return GameParticipant
     */
    public function getHomeParticipant(): ?GameParticipant
    {
        return $this->homeParticipant;
    }

    /**
     * @param GameParticipant $homeParticipant
     *
     * @return $this
     */
    public function setHomeParticipant(GameParticipant $homeParticipant)
    {
        $this->homeParticipant = $homeParticipant;

        return $this;
    }

    /**
     * @return GameParticipant
     */
    public function getAwayParticipant(): ?GameParticipant
    {
        return $this->awayParticipant;
    }

    /**
     * @param GameParticipant $awayParticipant
     *
     * @return $this
     */
    public function setAwayParticipant(GameParticipant $awayParticipant)
    {
        $this->awayParticipant = $awayParticipant;

        return $this;
    }

    /**
     * @return int
     */
    public function playedSetsCount()
    {
        return $this->sets->count();
    }

    /**
     * @return Set[]
     */
    public function getSets()
    {
        return $this->sets->getValues();
    }

    /**
     * @param Set $set
     *
     * @return $this
     */
    public function addSet(Set $set)
    {
        $nextSetIndex = $this->sets->count();

        $this->sets->add($set);

        $set->setGame($this);
        $set->setSetIndex($nextSetIndex);

        return $this;
    }
}

<?php

namespace App\Repository;


use App\Entity\Game;
use Doctrine\ORM\EntityRepository;

class GameRepository extends EntityRepository
{
    /**
     * @return Game
     */
    public function getLatestGame(): ?Game
    {
        $queryBuilder = $this->createQueryBuilder('game');

        $queryBuilder
            ->select()
            ->orderBy('game.dateTime', 'DESC');

        return $queryBuilder
            ->getQuery()
            ->getSingleResult();
    }
}

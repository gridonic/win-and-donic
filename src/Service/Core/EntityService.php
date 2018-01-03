<?php

/*
 * This file is part of the win-and-donic sample project.
 *
 * Copyright (c) Gridonic AG <hello@gridonic.ch>
 */

namespace App\Service\Core;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;

/**
 * Encapsulates storage and flush methods of EntityManager, to be more independent of Doctrine specific classes.
 */
class EntityService
{
    /** @var EntityManager */
    private $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param mixed $entity
     *
     * @return mixed
     */
    public function persistEntity($entity)
    {
        $this->entityManager->persist($entity);

        return $entity;
    }

    /**
     * Saves all changes made on entities in the database.
     *
     * NOTE: Whenever possible, you should only call this method on a top-level, e.g. in a controller method.
     * When using this method in services, the logic of when changes are actually stored in the database may become confusing.
     *
     * @throws OptimisticLockException
     */
    public function flush()
    {
        $this->entityManager->flush();
    }
}

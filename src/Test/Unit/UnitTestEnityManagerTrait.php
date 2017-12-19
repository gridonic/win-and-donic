<?php

/*
 * This file is part of the win-and-donic sample project.
 *
 * Copyright (c) Gridonic AG <hello@gridonic.ch>
 */

namespace App\Test\Unit;


use App\Service\Core\EntityService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use PHPUnit_Framework_MockObject_MockObject;
use ReflectionClass;

trait UnitTestEnityManagerTrait
{
    use UnitTestBaseTrait;

    /** @var EntityManager */
    private $entityManagerMock;

    /** @var EntityService */
    private $entityServiceMock;

    /** @var array<string, array> */
    private $entities;

    /**
     * @param string $entityName
     *
     * @return EntityRepository|PHPUnit_Framework_MockObject_MockObject
     */
    protected function useRepository(string $entityName)
    {
        $repositoryMock = $this->createRepository($entityName);

        $this
            ->getEntityManager()
            ->method('getRepository')
            ->with($entityName)
            ->willReturn($repositoryMock);

        return $repositoryMock;
    }

    /**
     * @return EntityManager|PHPUnit_Framework_MockObject_MockObject
     */
    protected function getEntityManager()
    {
        if ($this->entityManagerMock === null) {
            $this->entityManagerMock = $this->createEntityManager();
        }

        return $this->entityManagerMock;
    }

    /**
     * @return EntityService
     */
    public function getEntityService()
    {
        if ($this->entityServiceMock === null) {
            $this->entityServiceMock = $this->createEntityService();
        }

        return $this->entityServiceMock;
    }

    /**
     * @param string $entityName
     *
     * @return array
     */
    protected function allEntitiesOfType(string $entityName)
    {
        return $this->entities[$entityName] ?? array();
    }

    /**
     * @param string $entityName
     * @param array $criteria
     *
     * @return array
     */
    protected function entitiesBy(string $entityName, $criteria)
    {
        $reflectionClass = new ReflectionClass($entityName);
        $results = $this->allEntitiesOfType($entityName);

        foreach ($criteria as $key => $value) {
            $results = array_filter(
                $results,
                function ($item) use ($key, $value, $reflectionClass) {
                    return $reflectionClass->getMethod('get' . ucfirst($key))->invoke($item) === $value;
                }
            );
        }

        return $results;
    }

    /**
     * @param string $entityName
     *
     * @return int
     */
    protected function nextEntityId(string $entityName)
    {
        return count($this->entities[$entityName]) + 1;
    }

    /**
     * @return EntityService|PHPUnit_Framework_MockObject_MockObject
     */
    private function createEntityService()
    {
        $entityServiceMock =
            $this->getMockBuilder('App\Service\Core\EntityService')
                ->disableOriginalConstructor()
                ->getMock();

        $entityServiceMock
            ->method('persistEntity')
            ->will(
                $this->returnCallback(
                    function ($entity) {
                        if (!in_array($entity, $this->entities[get_class($entity)] ?? array())) {
                            $this->entities[get_class($entity)][] = $entity;
                        }

                        return $entity;
                    }
                )
            );

        return $entityServiceMock;
    }

    /**
     * @return EntityManager|PHPUnit_Framework_MockObject_MockObject
     */
    private function createEntityManager(): EntityManager
    {
        return
            $this->getMockBuilder(EntityManager::class)
                ->disableOriginalConstructor()
                ->getMock();
    }

    /**
     * @param string $entityName
     * @return EntityRepository|PHPUnit_Framework_MockObject_MockObject
     */
    private function createRepository(string $entityName)
    {
        $repositoryMock = $this->getMockBuilder(EntityRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $repositoryMock
            ->method('findAll')
            ->will(
                $this->returnCallback(
                    function () use ($entityName) {
                        return $this->allEntitiesOfType($entityName);
                    }
                )
            );

        $repositoryMock
            ->method('findBy')
            ->will(
                $this->returnCallback(
                    function ($criteria) use ($entityName) {
                        return $this->entitiesBy($entityName, $criteria);
                    }
                )
            );

        $repositoryMock
            ->method('findOneBy')
            ->will(
                $this->returnCallback(
                    function ($criteria) use ($entityName) {
                        return $this->entitiesBy($entityName, $criteria)[0] ?? null;
                    }
                )
            );

        $repositoryMock
            ->method('find')
            ->will(
                $this->returnCallback(
                    function ($id) use ($entityName) {
                        return $this->entitiesBy($entityName, array('id' => $id))[0] ?? null;
                    }
                )
            );

        return $repositoryMock;
    }
}

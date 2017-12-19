<?php

/*
 * This file is part of the win-and-donic sample project.
 *
 * Copyright (c) Gridonic AG <hello@gridonic.ch>
 */

namespace App\Test\Unit;


use Doctrine\ORM\EntityRepository;
use PHPUnit_Framework_MockObject_MockBuilder;
use PHPUnit_Framework_MockObject_Stub_ReturnCallback;

trait UnitTestBaseTrait
{
    /**
     * @param string $className
     *
     * @return PHPUnit_Framework_MockObject_MockBuilder
     */
    public abstract function getMockBuilder($className);

    /**
     * @param string $entityName
     *
     * @return EntityRepository
     */
    public abstract function useRepository(string $entityName);

    /**
     * @param mixed $callback
     *
     * @return PHPUnit_Framework_MockObject_Stub_ReturnCallback
     */
    abstract public static function returnCallback($callback);
}

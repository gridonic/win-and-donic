<?php

/*
 * This file is part of the win-and-donic sample project.
 *
 * Copyright (c) Gridonic AG <hello@gridonic.ch>
 */

namespace App\Test;


use PHPUnit\Framework\TestCase;
use App\Test\Unit\UnitTestEnityManagerTrait;

class UnitTestBase extends TestCase
{
    use UnitTestEnityManagerTrait;
}

<?php

/*
 * This file is part of the win-and-donic sample project.
 *
 * Copyright (c) Gridonic AG <hello@gridonic.ch>
 */

namespace App\Test\Mock;


use App\Service\Core\DateTimeService;
use DateTime;

class DateTimeServiceMock extends DateTimeService
{
    /** @var DateTime */
    private $fakeNow;

    public function __construct()
    {
        $this->fakeNow = new DateTime('2018-03-01 12:15:55'); // TODO: parameter
    }

    /**
     * @param mixed $fakeNow
     */
    public function setFakeNow($fakeNow)
    {
        $this->fakeNow = $fakeNow;
    }

    public function now()
    {
        if ($this->fakeNow !== null) {
            return $this->fakeNow;
        }

        return parent::now();
    }
}

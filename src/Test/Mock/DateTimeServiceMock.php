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
    const DEFAULT_NOW = '2018-03-01 12:15:55';

    /** @var DateTime */
    private $fakeNow;

    public function __construct()
    {
        $this->fakeNow = new DateTime(self::DEFAULT_NOW); // TODO: parameter
    }

    /**
     * @param mixed $fakeNow
     *
     * @return DateTime
     */
    public function updateFakeNow($fakeNow)
    {
        if ($fakeNow instanceof DateTime) {
            $this->fakeNow = $fakeNow;
        } else {
            $this->fakeNow = new DateTime($fakeNow);
        }

        return $fakeNow;
    }

    public function now()
    {
        if ($this->fakeNow !== null) {
            return $this->fakeNow;
        }

        return parent::now();
    }
}

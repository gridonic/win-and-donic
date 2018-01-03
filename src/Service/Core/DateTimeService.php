<?php

/*
 * This file is part of the win-and-donic sample project.
 *
 * Copyright (c) Gridonic AG <hello@gridonic.ch>
 */

namespace App\Service\Core;


use DateTime;

/**
 * Basic service for handling date time
 */
class DateTimeService
{
    /**
     * Gets the current date and time.
     *
     * @return DateTime
     */
    public function now()
    {
        return new DateTime();
    }
}

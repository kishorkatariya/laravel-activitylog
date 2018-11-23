<?php

namespace Kishor\Activity;

use Kishor\Activity\Observer\ActivityObserver;

class Activity
{
    function __construct()
    {

    }

    public function createLog($parameter = [])
    {
        $obj = new ActivityObserver();

        $res = $obj->creating($parameter);

        return $res;
    }
}
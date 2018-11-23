<?php
/**
 * Created by PhpStorm.
 * User: rgi-39
 * Date: 20/11/18
 * Time: 6:32 PM
 */

namespace Kishor\Activity\Facades;


use Illuminate\Support\Facades\Facade;
class Activity extends Facade {
    protected static function getFacadeAccessor() { return 'activity'; }
}

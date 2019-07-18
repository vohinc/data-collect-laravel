<?php

namespace Voh\DataCollectLaravel\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class DataCollectApi
 *
 * @package Voh\DataCollectLaravel\Facade
 */
class DataCollectApi extends Facade
{
    /**
     * @see \Voh\DataCollectLaravel\ApiClient
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return self::class;
    }
}

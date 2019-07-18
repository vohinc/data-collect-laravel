<?php

namespace Voh\DataCollectLaravel\Exceptions;

use RuntimeException;

/**
 * Class MissingCodeException
 *
 * @package Voh\DataCollectLaravel\Exceptions
 */
class MissingCodeException extends RuntimeException
{
    /**
     * @var string
     */
    protected $message = 'Missing code';
}

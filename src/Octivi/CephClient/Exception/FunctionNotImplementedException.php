<?php

/*
 * Copyright 2014 IMAGIN Sp. z o.o. - imagin.pl
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Octivi\CephClient\Exception;

use Exception;

/**
 * FunctionNotImplementedException
 *
 * @author Rafał Lorenz <rlorenz@imagin.pl>
 */
class FunctionNotImplementedException extends Exception
{

    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

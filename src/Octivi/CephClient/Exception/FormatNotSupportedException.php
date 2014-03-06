<?php

/*
 * Copyright 2014 IMAGIN Sp. z o.o. - imagin.pl
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Octivi\CephClient\Exception;

/**
 * FormatNotSupportedException
 *
 * @author Antoni Orfin <aorfin@imagin.pl>
 */
class FormatNotSupportedException extends \Exception
{
    /**
     * @var string[]
     */
    protected $supportedFormats;

    public function __construct($format, array $supportedFormats, $code = 0, \Exception $previous = null)
    {
        $message = sprintf('Format "%s" is not supported. Supported formats are: %s', $format, implode(', ', $supportedFormats));
        parent::__construct($message, $code, $previous);
    }

    public function getSupportedFormats()
    {
        return $this->supportedFormats;
    }
}

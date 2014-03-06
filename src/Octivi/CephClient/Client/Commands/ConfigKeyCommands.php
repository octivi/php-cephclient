<?php

/*
 * Copyright 2014 IMAGIN Sp. z o.o. - imagin.pl
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Octivi\CephClient\Client\Commands;

use Octivi\CephClient\Client\CommandsWrapper;

/**
 * ConfigKeyCommands
 *
 * @author Rafał Lorenz <rlorenz@imagin.pl>
 */
class ConfigKeyCommands extends CommandsWrapper
{

    public function exists($key)
    {
        return $this->getCurl('config-key/exists?key=' . $key);
    }

    public function get($key)
    {
        return $this->getCurl('config-key/get?key=' . $key);
    }

    public function showList()
    {
        return $this->getCurl('config-key/list');
    }

}
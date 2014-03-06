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
 * MonCommands
 *
 * @author Rafał Lorenz <rlorenz@imagin.pl>
 */
class MonCommands extends CommandsWrapper
{

    public function dump($epoch = null)
    {
        if ($epoch != null) {
            return $this->getCurl('mon/dump?epoch=' . $epoch);
        } else {
            return $this->getCurl('mon/dump');
        }
    }

    public function getMap($epoch = null)
    {
        if ($epoch != null) {
            return $this->getCurl('mon/getmap?epoch=' . $epoch, 'binary');
        } else {
            return $this->getCurl('mon/getmap', 'binary');
        }
    }

    public function stat()
    {
        return $this->getCurl('mon/stat', 'xml');
    }

    public function status()
    {
        return $this->getCurl('mon_status');
    }

    public function add($name, $addr)
    {
        return $this->putCurl('mon/add?name=' . $name . '&addr=' . $addr);
    }

    public function remove($name)
    {
        return $this->putCurl('mon/remove?name=' . $name);
    }

}
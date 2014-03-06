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
 * PgCommands
 *
 * @author Rafał Lorenz <rlorenz@imagin.pl>
 */
class PgCommands extends CommandsWrapper
{

    public function debug($debugop)
    {
        return $this->getCurl('pg/debug?debugop=' . $debugop, 'xml');
    }

    public function dump($dumpcontents = null)
    {
        if ($dumpcontents != null) {
            return $this->getCurl('pg/dump?dumpcontents=' . $dumpcontents);
        } else {
            return $this->getCurl('pg/dump');
        }
    }

    public function dumpJson($dumpcontents = null)
    {
        if ($dumpcontents != null) {
            return $this->getCurl('pg/dump_json?dumpcontents=' . $dumpcontents);
        } else {
            return $this->getCurl('pg/dump_json');
        }
    }

    public function dumpPoolsJson()
    {
        return $this->getCurl('pg/dump_pools_json');
    }

    public function dumpStuck($stuckops = null)
    {
        if ($stuckops != null) {
            return $this->getCurl('pg/dump_stuck?stuckops=' . $stuckops);
        } else {
            return $this->getCurl('pg/dump_stuck');
        }
    }

    public function getMap()
    {
        return $this->getCurl('pg/getmap', 'binary');
    }

    public function map($pgid)
    {
        return $this->getCurl('pg/map?pgid=' . $pgid);
    }

    public function stat()
    {
        return $this->getCurl('pg/stat');
    }
}
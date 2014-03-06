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
 * TellCommands
 *
 * @author Rafał Lorenz <rlorenz@imagin.pl>
 */
class TellCommands extends CommandsWrapper
{

    public function debugDumpMissing($id, $filename)
    {
        return $this->getCurl('/tell/' . $id . '/debug_dump_missing?filename=' . $filename);
    }

    public function dumpPgRecoveryStats($id)
    {
        return $this->getCurl('/tell/' . $id . '/dump_pg_recovery_stats');
    }

    public function listMissing($id, $offset)
    {
        return $this->getCurl('/tell/' . $id . '/list_missing?offset=' . $offset);
    }

    public function query($id)
    {
        return $this->getCurl('/tell/' . $id . '/query');
    }

    public function version($id)
    {
        return $this->getCurl('/tell/' . $id . '/version');
    }
}
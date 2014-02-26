<?php
/*
    php-cephcielnt is a PHP library to communicate with Ceph's REST API
    Copyright (C) 2014  IMAGIN Sp. z o.o.
    Author: Rafał Lorenz <rlorenz@imagin.pl>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Octivi\CephClient\Client\Calls;

use Octivi\CephClient\Client\CallsWrapper;

class TellCalls extends CallsWrapper
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
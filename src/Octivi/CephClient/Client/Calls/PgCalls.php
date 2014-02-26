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

class PgCalls extends CallsWrapper
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
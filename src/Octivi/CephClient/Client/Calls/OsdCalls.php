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

class OsdCalls extends CallsWrapper
{

    public function blacklistLs()
    {
        return $this->getCurl('osd/blacklist/ls');
    }

    public function crushDump()
    {
        return $this->getCurl('osd/crush/dump');
    }

    public function crushRuleDump()
    {
        return $this->getCurl('osd/crush/rule/dump');
    }

    public function crushRuleList()
    {
        return $this->getCurl('osd/crush/rule/list');
    }

    public function crushRuleLs()
    {
        return $this->getCurl('osd/crush/rule/ls');
    }

    public function dump($epoch = null)
    {
        if ($epoch != null) {
            return $this->getCurl('osd/dump?epoch=' . $epoch);
        } else {
            return $this->getCurl('osd/dump');
        }
    }

    public function find($id)
    {
        return $this->getCurl('osd/find?id=' . $id);
    }

    public function getCrushMap($epoch = null)
    {
        if ($epoch != null) {
            return $this->getCurl('osd/getcrushmap?epoch=' . $epoch, 'binary');
        } else {
            return $this->getCurl('osd/getcrushmap', 'binary');
        }
    }

    public function getMap($epoch = null)
    {
        if ($epoch != null) {
            return $this->getCurl('osd/getmap?epoch=' . $epoch, 'binary');
        } else {
            return $this->getCurl('osd/getmap', 'binary');
        }
    }

    public function getMaxOsd()
    {
        return $this->getCurl('osd/getmaxosd');
    }

    public function ls($epoch = null)
    {
        if ($epoch != null) {
            return $this->getCurl('osd/ls?epoch=' . $epoch);
        } else {
            return $this->getCurl('osd/ls');
        }
    }

    public function lsPools($auid = null)
    {
        if ($auid != null) {
            return $this->getCurl('osd/lspools?auid=' . $auid);
        } else {
            return $this->getCurl('osd/lspools');
        }
    }

    public function map($pool, $object)
    {
        return $this->getCurl('osd/map?pool=' . $pool . '&object=' . $object);
    }

    public function perf()
    {
        return $this->getCurl('osd/perf');
    }

    public function getPool($pool, $var)
    {
        return $this->getCurl('osd/pool/get?pool=' . $pool . '&var=' . $var);
    }

    public function poolStats($name = null)
    {
        if ($name != null) {
            return $this->getCurl('osd/pool/stats?name=' . $name);
        } else {
            return $this->getCurl('osd/pool/stats');
        }
    }

    public function stat()
    {
        return $this->getCurl('osd/stat');
    }

    public function tree($epoch = null)
    {
        if ($epoch != null) {
            return $this->getCurl('osd/tree?epoch=' . $epoch);
        } else {
            return $this->getCurl('osd/tree');
        }
    }

}
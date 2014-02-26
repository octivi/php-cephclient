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

class MonCalls extends CallsWrapper
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
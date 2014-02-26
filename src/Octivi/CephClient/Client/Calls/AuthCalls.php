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
use Octivi\CephClient\Exception\FunctionNotImplementedException;

class AuthCalls extends CallsWrapper
{

    public function export($entity = null)
    {
        if ($entity != null) {
            $this->getCurl('auth/export?entity=' . $entity);
        } else {
            $this->getCurl('auth/export');
        }
    }

    public function get($entity)
    {
        $this->getCurl('auth/get?entity=' . $entity);
    }

    public function getKey($entity)
    {
        $this->getCurl('auth/get-key?entity=' . $entity);
    }

    public function showList()
    {
        $this->getCurl('auth/list');
    }

    public function printKey($entity)
    {
        $this->getCurl('auth/print-key?entity=' . $entity);
    }

    public function add($entity, $caps = array(), $file = null)
    {
        # XXX-TODO{ Implement file input
        return $this->putCurl('auth/add?entity=' . $entity . $this->getFormatted($caps));
    }

    public function caps($entity, $caps = array())
    {
        return $this->putCurl('auth/caps?entity=' . $entity . $this->getFormatted($caps));
    }

    public function del($entity)
    {
        return $this->putCurl('auth/del?entity=' . $entity);
    }

    public function getOrCreate($entity, $caps = array(), $file = null)
    {
        # XXX-TODO{ Implement file input
        return $this->putCurl('auth/get-or-create?entity=' . $entity . $this->getFormatted($caps));
    }

    public function getOrCreate_key($entity, $caps = array())
    {
        # XXX-TODO{ Implement file input
        return $this->putCurl('auth/get-or-create-key?entity=' . $entity . $this->getFormatted($caps));
    }

    public function import($file)
    {
        # XXX-TODO{ Implement file input
        throw FunctionNotImplementedException("Function is not implemented yet!");
    }

    private function getFormatted($caps = array())
    {
        //Example caps = array('mon' => 'allow rwx', 'osd' => 'allow *');
        $caps_expanded = array();
        if ($caps) {
            foreach ($caps as $key => $value) {
                $permissions = str_replace(' ', '+', $value);
                $caps_expanded . array_push('&caps=' . $key . '&caps=' . $permissions);
            }
        }
        return implode('', $caps_expanded);
    }

}
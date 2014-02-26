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

class MdsCalls extends CallsWrapper
{

    public function showCompat()
    {
        return $this->getCurl('mds/compat/show');
    }

    public function dump($epoch = null)
    {
        if ($epoch != null) {
            return $this->getCurl('mds/dump?epoch=' . $epoch);
        } else {
            return $this->getCurl('mds/dump');
        }
    }

    public function getMap($epoch = null)
    {
        if ($epoch != null) {
            return $this->getCurl('mds/getmap?epoch=' . $epoch, 'binary');
        } else {
            return $this->getCurl('mds/getmap', 'binary');
        }
    }

    public function stat()
    {
        return $this->getCurl('mds/stat');
    }

    public function addDataPool($pool)
    {
        return $this->putCurl('mds/add_data_pool?pool=' . $pool);
    }

    public function downCluster()
    {
        return $this->putCurl('mds/cluster_down');
    }

    public function upCluster()
    {
        return $this->putCurl('mds/cluster_up');
    }

    public function compatCompatRm($feature)
    {
        return $this->putCurl('mds/compat/rm_compat?feature=' . $feature);
    }

    public function incompatCompatRm($feature)
    {
        return $this->putCurl('mds/compat/rm_incompat?feature=' . $feature);
    }

    public function deactivate($who)
    {
        return $this->putCurl('mds/deactivate?who=' . $who);
    }

    public function fail($who)
    {
        return $this->putCurl('mds/fail?who=' . $who);
    }

    public function newFs($metadata, $data, $sure)
    {
        return $this->putCurl('mds/newfs?metadata=' . $metadata . '&data=' . $data . '&sure=' . $sure);
    }

    public function removeDataPool($pool)
    {
        return $this->putCurl('mds/remove_data_pool?pool=' . $pool);
    }

    public function rm($gid, $who)
    {
        return $this->putCurl('mds/rm?gid=' . $gid . '&who=' . $who);
    }

    public function rmFailed($who)
    {
        return $this->putCurl('mds/rmfailed?who=' . $who);
    }

    public function setAllowNewSnaps($sure)
    {
        //mds/set?key=allow_new_snaps&sure= 
        throw FunctionNotImplementedException("Function is not implemented yet!");
    }

    public function setMaxMds($maxmds)
    {
        return $this->putCurl('mds/set_max_mds?maxmds=' . $maxmds);
    }

    public function setMap($epoch)
    {
        return $this->putCurl('mds/setmap?epoch=' . $epoch);
    }

    public function stop($who)
    {
        return $this->putCurl('mds/stop?who=' . $who);
    }

    public function tell($who, $args)
    {
        return $this->putCurl('mds/tell?who=' . $who . '&args=' . $args);
    }

    public function unsetAllowNewSnaps($sure)
    {
        //mds/unset?key=allow_new_snaps&sure=
        throw FunctionNotImplementedException("Function is not implemented yet!");
    }

}
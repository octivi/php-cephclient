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

class RootCalls extends CallsWrapper
{

    public function df($detail = null)
    {
        if ($detail != null) {
            return $this->getCurl('df?detail=' . $detail);
        } else {
            return $this->getCurl('df');
        }
    }

    public function fsId()
    {
        return $this->getCurl('fsid');
    }

    public function health($detail = null)
    {
        if ($detail != null) {
            return $this->getCurl('health?detail=' . $detail);
        } else {
            return $this->getCurl('health');
        }
    }

    public function quorumStatus()
    {
        return $this->getCurl('quorum_status');
    }

    public function report($tags = null)
    {
        if ($tags != null) {
            return $this->getCurl('report?tags=' . $tags);
        } else {
            return $this->getCurl('report');
        }
    }

    public function status()
    {
        return $this->getCurl('status');
    }

    public function compact()
    {
        return $this->putCurl('compact');
    }

    public function heap($heapcmd)
    {
        return $this->putCurl('heap?heapcmd=' . $heapcmd);
    }

    public function injectArgs($injected_args)
    {
        return $this->putCurl('injectargs?injected_args=' . $injected_args);
    }

    public function log($logtext)
    {
        return $this->putCurl('log?logtext=' . $logtext);
    }

    public function quorum($quorumcmd)
    {
        return $this->putCurl('quorum?quorumcmd=' . $quorumcmd);
    }

    public function scrub()
    {
        return $this->putCurl('scrub');
    }

    public function tell($target, $args)
    {
        return $this->putCurl('tell?target=' . $target . '&args=' . $args);
    }

}
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
 * RootCommands
 *
 * @author Rafał Lorenz <rlorenz@imagin.pl>
 */
class RootCommands extends CommandsWrapper
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

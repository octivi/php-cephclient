<?php

namespace Client\Calls;

use Client\CallsWrapper;

class OsdCalls extends CallsWrapper {

    public function blacklistLs() {
        return $this->getCurl('osd/blacklist/ls');
    }

    public function crushDump() {
        return $this->getCurl('osd/crush/dump');
    }

    public function crushRuleDump() {
        return $this->getCurl('osd/crush/rule/dump');
    }

    public function crushRuleList() {
        return $this->getCurl('osd/crush/rule/list');
    }

    public function crushRuleLs() {
        return $this->getCurl('osd/crush/rule/ls');
    }

    public function dump($epoch = null) {
        if ($epoch != null) {
            return $this->getCurl('osd/dump?epoch=' . $epoch);
        } else {
            return $this->getCurl('osd/dump');
        }
    }

    public function find($id) {
        return $this->getCurl('osd/find?id=' . $id);
    }

    public function getCrushMap($epoch = null) {
        if ($epoch != null) {
            return $this->getCurl('osd/getcrushmap?epoch=' . $epoch, 'binary');
        } else {
            return $this->getCurl('osd/getcrushmap', 'binary');
        }
    }

    public function getMap($epoch = null) {
        if ($epoch != null) {
            return $this->getCurl('osd/getmap?epoch=' . $epoch, 'binary');
        } else {
            return $this->getCurl('osd/getmap', 'binary');
        }
    }

    public function getMaxOsd() {
        return $this->getCurl('osd/getmaxosd');
    }

    public function ls($epoch = null) {
        if ($epoch != null) {
            return $this->getCurl('osd/ls?epoch=' . $epoch);
        } else {
            return $this->getCurl('osd/ls');
        }
    }

    public function lsPools($auid = null) {
        if ($auid != null) {
            return $this->getCurl('osd/lspools?auid=' . $auid);
        } else {
            return $this->getCurl('osd/lspools');
        }
    }

    public function map($pool, $object) {
        return $this->getCurl('osd/map?pool=' . $pool . '&object=' . $object);
    }

    public function perf() {
        return $this->getCurl('osd/perf');
    }

    public function getPool($pool, $var) {
        return $this->getCurl('osd/pool/get?pool=' . $pool . '&var=' . $var);
    }

    public function poolStats($name = null) {
        if ($name != null) {
            return $this->getCurl('osd/pool/stats?name=' . $name);
        } else {
            return $this->getCurl('osd/pool/stats');
        }
    }

    public function stat() {
        return $this->getCurl('osd/stat');
    }

    public function tree($epoch = null) {
        if ($epoch != null) {
            return $this->getCurl('osd/tree?epoch=' . $epoch);
        } else {
            return $this->getCurl('osd/tree');
        }
    }

}

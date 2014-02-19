<?php

namespace Client\Calls;

use Client\CallsWrapper;

class TellCalls extends CallsWrapper{

    public function debugDumpMissing($id, $filename) {
        return $this->getCurl('/tell/' . $id . '/debug_dump_missing?filename=' . $filename);
    }

    public function dumpPgRecoveryStats($id) {
        return $this->getCurl('/tell/' . $id . '/dump_pg_recovery_stats');
    }

    public function listMissing($id, $offset) {
        return $this->getCurl('/tell/' . $id . '/list_missing?offset=' . $offset);
    }

    public function query($id) {
        return $this->getCurl('/tell/' . $id . '/query');
    }

    public function version($id) {
        return $this->getCurl('/tell/' . $id . '/version');
    }

}
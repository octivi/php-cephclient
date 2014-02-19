<?php

namespace Client\Calls;

use Client\CallsWrapper;

class ConfigKeyCalls extends CallsWrapper {

    public function exists($key) {
        return $this->getCurl('config-key/exists?key=' . $key);
    }

    public function get($key) {
        return $this->getCurl('config-key/get?key=' . $key);
    }

    public function showList() {
        return $this->getCurl('config-key/list');
    }

}

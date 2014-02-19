<?php

namespace Octivi\CephClient\Client\Calls;

use Octivi\CephClient\Client\CallsWrapper;

class AuthCalls extends CallsWrapper {

    public function export($entity = null) {
        if ($entity != null) {
            $this->getCurl('auth/export?entity=' . $entity);
        } else {
            $this->getCurl('auth/export');
        }
    }

    public function get($entity) {
        $this->getCurl('auth/get?entity=' . $entity);
    }

    public function getKey($entity) {
        $this->getCurl('auth/get-key?entity=' . $entity);
    }

    public function showList() {
        $this->getCurl('auth/list');
    }

    public function printKey($entity) {
        $this->getCurl('auth/print-key?entity=' . $entity);
    }

    public function add($entity, $caps = array(), $file = null) {
        # XXX-TODO{ Implement file input
        return $this->putCurl('auth/add?entity=' . $entity . $this->getFormatted($caps));
    }

    public function caps($entity, $caps = array()) {
        return $this->putCurl('auth/caps?entity=' . $entity . $this->getFormatted($caps));
    }

    public function del($entity) {
        return $this->putCurl('auth/del?entity=' . $entity);
    }

    public function getOrCreate($entity, $caps = array(), $file = null) {
        # XXX-TODO{ Implement file input
        return $this->putCurl('auth/get-or-create?entity=' . $entity . $this->getFormatted($caps));
    }

    public function getOrCreate_key($entity, $caps = array()) {
        # XXX-TODO{ Implement file input
        return $this->putCurl('auth/get-or-create-key?entity=' . $entity . $this->getFormatted($caps));
    }

    public function import($file) {
        # XXX-TODO{ Implement file input
        throw FunctionNotImplementedException("Function is not implemented yet!");
    }

    private function getFormatted($caps = array()) {
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

<?php

namespace PFC\Editor\Component\View;

class ActionView extends JsonView
{
    protected $succ = false;
    protected $msg = "";
    protected $addedData = [];
    
    public function setSucc($succ) {
        $this->succ = (bool) $succ;
    }
    
    public function isSucc() {
        return $this->succ;
    }
    
    public function setMsg($msg) {
        $this->msg = $msg;
    }
    
    public function getMsg() {
        return $this->msg;
    }
    
    public function addData(array $data) {
        array_merge_recursive($this->addedData, $data);
    }
    
    public function getAddedData() {
        return $this->addedData;
    }
    
    public function render() {
        $this->setData(
          array_merge_recursive([
                'succ' => $this->isSucc() ? 'yes' : 'no',
                'msg' => $this->getMsg(),
            ], $this->getAddedData())
        );
        
        return parent::render();
    }
}



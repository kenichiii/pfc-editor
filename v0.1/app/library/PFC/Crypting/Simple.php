<?php

namespace PFC\Crypting;

class Simple
{
    protected $salt = 'sdai-qwu9-231y81310[6%*&*$&^#%&%00q78938-922[-389ew0-9ewd-u';
    
    public function __construct($salt=null)
    {
        if($salt) $this->salt = $salt;
    }
    
    public function getSalt() {
        return $this->salt;
    }
    
    public function verify($input,$hash)
    {
        return $hash == $this->hash($input);
    }

    public function hash($input)
    {
        return md5($input.$this->getSalt());
    }
    
}


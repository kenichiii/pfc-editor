<?php

namespace PFC\Crypting;

interface iCrypting
{
    public function getSalt();
    public function verify($input,$hash);
    public function hash($input);
}


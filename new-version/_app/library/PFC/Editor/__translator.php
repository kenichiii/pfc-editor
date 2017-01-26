<?php

namespace {
    if(!function_exists('_')) {
        function _($string, array $data = []) {        
            return \PFC\Editor\App::ins()->translate($string, $data);
        }
    }
}


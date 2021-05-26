<?php

namespace {
    if(!function_exists('_tr')) {
        function _tr($string, array $data = []) {        
            return \PFC\Editor\App::ins()->translate($string, $data);
        }
    }
}


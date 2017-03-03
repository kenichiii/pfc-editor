<?php

namespace {
    if(!function_exists('_tr')) {
        function _tr($string, array $data = []) {        
            return \PFC\WebApp\App::ins()->translate($string, $data);
        }
    }
}


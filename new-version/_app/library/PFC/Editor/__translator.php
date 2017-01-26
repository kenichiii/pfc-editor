<?php

namespace {
    if(!function_exists('_')) {
        function _($string, array $data = []) {        
            return App::translate($string, $data);
        }
    }
}


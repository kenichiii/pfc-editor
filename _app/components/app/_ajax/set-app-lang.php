<?php

namespace pfcEditor\Component\Ajax\app;

use PFC\Editor\Component\AjaxController;
use PFC\Editor\Component\View\TextView;

class setAppLang extends AjaxController
{
    public function indexAction() {
        
        $lang = filter_input(INPUT_GET, 'pfc_lang');
        \PFC\Editor\App::ins()->setLang($lang);
        
        return self::redirect('__HOME__');
    }
}  
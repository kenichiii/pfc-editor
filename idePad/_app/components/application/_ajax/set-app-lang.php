<?php

namespace idePad\Component\Ajax\application;

use PFC\WebApp\Component\AjaxController;
use PFC\WebApp\App;
use PFC\WebApp\AppSess;

class setAppLang extends AjaxController
{
    public function indexAction() {
        
        $lang = filter_input(INPUT_GET, 'lang');
        //App::ins()->setLang($lang);
        if(in_array($lang, App::ins()->getLanguages())) {
            AppSess::set('lang', $lang);
        }
        
        return self::redirect('__HOME__');
    }
}  
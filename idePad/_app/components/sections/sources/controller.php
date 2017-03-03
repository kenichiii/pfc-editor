<?php 

namespace pfcEditor\Component\sections;

use PFC\Editor\Component\ComponentController;

class sources extends ComponentController
{
    public function indexAction()
    {
        $this->getView()->setParam(
                'sections', 
                \PFC\Editor\Config\Sources::getBySections()
            );
    }
}

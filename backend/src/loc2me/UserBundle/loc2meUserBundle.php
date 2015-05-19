<?php

namespace loc2me\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class loc2meUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}

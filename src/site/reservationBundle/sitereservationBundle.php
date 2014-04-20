<?php

namespace site\reservationBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class sitereservationBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}

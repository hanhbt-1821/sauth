<?php

namespace SocialiteProviders\SunAsterisk;

use SocialiteProviders\Manager\SocialiteWasCalled;

class SunAsteriskExtendSocialite
{
    /**
     * Execute the provider.
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite('sunasterisk', __NAMESPACE__.'\Provider');
    }
}

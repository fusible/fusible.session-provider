<?php
// @codingStandardsIgnoreFile

namespace Fusible\SessionProvider;

use Aura\Di\AbstractContainerConfigTest;

class ConfigTest extends AbstractContainerConfigTest
{
    protected function setUp()
    {
        @session_start();
        parent::setUp();
    }

    protected function getConfigClasses()
    {
        return [
            'Fusible\SessionProvider\Config'
        ];
    }

    public function provideGet()
    {
        return [
            ['aura/session:factory', 'Aura\Session\SessionFactory'],
            ['aura/session:session', 'Aura\Session\Session'],
            ['aura/session:csrf', 'Aura\Session\CsrfToken'],
        ];
    }

    public function provideNewInstance()
    {
        return [
            ['Aura\Session\SessionFactory']
        ];
    }

}


<?php
// @codingStandardsIgnoreFile

namespace Fusible\SessionProvider;

use Aura\Di\AbstractContainerConfigTest;
use Aura\Session;

class ConfigTest extends AbstractContainerConfigTest
{
    protected function setUp()
    {
        $prev = error_reporting(0);
        @session_start();
        error_reporting($prev);
        parent::setUp();
    }

    protected function getConfigClasses()
    {
        return [Config::class];
    }

    public function provideGet()
    {
        return [
            [Session\SessionFactory::class, Session\SessionFactory::class],
            [Session\Session::class, Session\Session::class],
            // [Session\CsrfToken::class, Session\CsrfToken::class]
        ];
    }

    public function provideNewInstance()
    {
        return [
            [Session\SessionFactory::class]
        ];
    }

}


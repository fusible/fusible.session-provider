<?php
/**
 * Aura\Session Provider for Aura\Di
 *
 * PHP version 5
 *
 * Copyright (C) 2016 Jake Johns
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 *
 * @category  Config
 * @package   Fusible\SessionProvider
 * @author    Jake Johns <jake@jakejohns.net>
 * @copyright 2016 Jake Johns
 * @license   http://jnj.mit-license.org/2016 MIT License
 * @link      https://github.com/fusible/fusible.session-provider
 */

namespace Fusible\SessionProvider;

use Aura\Di\Container;
use Aura\Di\ContainerConfig;

use Aura\Session;

/**
 * Config
 *
 * @category Config
 * @package  Fusible\SessionProvider
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://jnj.mit-license.org/2016 MIT License
 * @link     https://github.com/fusible/fusible.session-provider
 *
 * @see ContainerConfig
 */
class Config extends ContainerConfig
{
    /**
     * Cookie
     *
     * @var array
     *
     * @access protected
     */
    protected $cookie;

    /**
     * __construct
     *
     * @param array $cookie Cookie array
     *
     * @access public
     */
    public function __construct(array $cookie = null)
    {
        $this->cookie = $cookie ?? $_COOKIE;
    }

    /**
     * Define Aura\Session factories and services
     *
     * @param Container $di DI Container
     *
     * @return void
     *
     * @access public
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function define(Container $di)
    {
        if (! isset($di->values[Cookie::class])) {
            $di->values[Cookie::class] = $this->cookie;
        }

        $di->set(
            Session\SessionFactory::class,
            $di->lazyNew(Session\SessionFactory::class)
        );

        $di->set(
            Session\Session::class,
            $di->lazyGetCall(
                Session\SessionFactory::class,
                'newInstance',
                $di->lazyValue(Cookie::class)
            )
        );

        $di->set(
            Session\CsrfToken::class,
            $di->lazyGetCall(
                Session\Session::class,
                'getCsrfToken'
            )
        );
    }
}

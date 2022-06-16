<?php

/**
 * This file is part of JohnCMS Content Management System.
 *
 * @copyright JohnCMS Community
 * @license   https://opensource.org/licenses/GPL-3.0 GPL-3.0
 * @link      https://johncms.com JohnCMS Project
 */

declare(strict_types=1);

namespace Johncms\System\View;

use Johncms\Security\Csrf;
use Johncms\System\Legacy\Tools;
use Johncms\Users\User;
use Johncms\System\View\Extension\Assets;
use Johncms\System\View\Extension\Avatar;
use Psr\Container\ContainerInterface;
use Johncms\System\i18n\Translator;

class AdminRenderEngineFactory
{
    public function __invoke(ContainerInterface $container): Render
    {
        $config = $container->get('config')['johncms'];
        $engine = new Render('phtml');
        $engine->setTheme('admin');
        $engine->addFolder('system', realpath(THEMES_PATH . 'admin/templates/system'));
        $engine->loadExtension($container->get(Assets::class));
        $engine->loadExtension($container->get(Avatar::class));
        $engine->addData(
            [
                'container'  => $container,
                'config'     => $config,
                'locale'     => $container->get(Translator::class)->getLocale(),
                'user'       => $container->get(User::class),
                'tools'      => $container->get(Tools::class),
                'csrf_token' => $container->get(Csrf::class)->getToken(),
            ]
        );

        return $engine;
    }
}

<?php
/*
 * This file is part of the Maker plugin
 *
 * Copyright (C) 2016 LOCKON CO.,LTD. All Rights Reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\Maker\ServiceProvider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Plugin\Maker\Event\Maker;

/**
 * Class MakerServiceProvider.
 */
class MakerServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {

        // Maker event
        $app['eccube.plugin.maker.event.maker'] = function () use ($app) {
            return new Maker($app);
        };

        $app['eccube.plugin.maker.repository.maker'] = function () use ($app) {
            return $app['orm.em']->getRepository('Plugin\Maker\Entity\Maker');
        };

        $app->extend('form.types', function ($types) use ($app) {
            $types[] = new \Plugin\Maker\Form\Type\MakerType();

            return $types;
        });

        $app->extend('translator', function ($translator, \Silex\Application $app) {
            $translator->addLoader('yaml', new \Symfony\Component\Translation\Loader\YamlFileLoader());

//            $file = __DIR__.'/../Resource/locale/validator.'.$app['locale'].'.yml';
//            if (file_exists($file)) {
//                $translator->addResource('yaml', $file, $app['locale'], 'validators');
//            }

            $file = __DIR__.'/../Resource/locale/message.'.$app['locale'].'.yml';
            if (file_exists($file)) {
                $translator->addResource('yaml', $file, $app['locale']);
            }

            return $translator;
        });
//        $app['config'] =
//        $app->extend('config', function ($config) {
//            dump($config);
//            $addNavi['id'] = 'maker';
//            $addNavi['name'] = 'メーカー管理';
//            $addNavi['url'] = 'admin_plugin_maker_index';
//            $nav = $config['nav'];
//            foreach ($nav as $key => $val) {
//                if ('product' == $val['id']) {
//                    $nav[$key]['child'][] = $addNavi;
//                }
//            }
//            $config['nav'] = $nav;
//
//            return $config;
//        });
    }

    /**
     * @param object $app
     */
    public function boot($app)
    {
    }
}

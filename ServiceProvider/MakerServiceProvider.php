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
        $app['eccube.plugin.maker.repository.maker'] = function () use ($app) {
            return $app['orm.em']->getRepository('Plugin\Maker\Entity\Maker');
        };

        $app->extend('form.types', function ($types) use ($app) {
            $types[] = new \Plugin\Maker\Form\Type\MakerType();

            return $types;
        });

//        dump($app['form.types']);
//        dump($app);
//        $app['config'] =
//        $app->extend('config', function ($config) {
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
     * @param $app
     */
    public function boot($app)
    {
    }
}

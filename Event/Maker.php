<?php
/*
 * This file is part of the Maker plugin
 *
 * Copyright (C) 2016 LOCKON CO.,LTD. All Rights Reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\Maker\Event;

use Doctrine\ORM\EntityRepository;
use Eccube\Entity\Product;
use Eccube\Event\EventArgs;
use Eccube\Common\Constant;
use Eccube\Event\TemplateEvent;
use Plugin\Maker\Entity\ProductMaker;
use Plugin\Maker\Repository\ProductMakerRepository;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Maker.
 * New event on version EC-CUBE version >= 3.0.9 (new hook point).
 */
class Maker extends CommonEvent
{
    /**
     * New event function on version >= 3.0.9 (new hook point)
     * Add/Edit product trigger.
     *
     * @param EventArgs $event
     */
    public function onAdminProductEditInitialize(EventArgs $event)
    {
    }

    /**
     * New Event:function on version >= 3.0.9 (new hook point)
     * Save event.
     *
     * @param EventArgs $eventArgs
     */
    public function onAdminProductEditComplete(EventArgs $eventArgs)
    {
    }

    /**
     * New event function on version >= 3.0.9 (new hook point)
     * Product detail render (front).
     *
     * @param TemplateEvent $event
     */
    public function onRenderProductDetail(TemplateEvent $event)
    {
    }
}

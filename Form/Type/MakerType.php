<?php
/*
 * This file is part of the Maker plugin
 *
 * Copyright (C) 2016 LOCKON CO.,LTD. All Rights Reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\Maker\Form\Type;

use Plugin\Maker\Entity\Maker;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class MakerType.
 */
class MakerType extends AbstractType
{
    /**
     * Build config type form.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'メーカー名',
                'required' => true,
                'constraints' => array(
                    new Assert\NotBlank(array('message' =>'admin.plugin.maker.blank.error')),
                ),
            ))
            ->add('id', HiddenType::class, array());
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Maker::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'admin_maker';
    }
}

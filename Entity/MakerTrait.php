<?php
/**
 * Created by PhpStorm.
 * User: lqdung
 * Date: 8/18/2017
 * Time: 2:16 PM
 */

namespace Plugin\Maker\Entity;

use Eccube\Annotation\EntityExtension;
use Eccube\Annotation as Eccube;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @EntityExtension("Eccube\Entity\Product")
 */
trait MakerTrait
{
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(message="入力してくださいね！！！")
     * @Eccube\FormAppend(
     *     auto_render=true,
     *     form_theme="Maker/Form/product_maker.twig",
     *     type="\Symfony\Component\Form\Extension\Core\Type\TextType",
     *     options={
     *          "required": true,
     *          "label": "Maker"
     *     })
     */
    public $maker_name;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Eccube\FormAppend(
     *     auto_render=true,
     *     form_theme="Maker/Form/product_maker_url.twig",
     *     type="\Symfony\Component\Form\Extension\Core\Type\TextType",
     *     options={
     *          "required": true,
     *          "label": "Maker url"
     *     })
     * @Assert\NotBlank(message="入力してくださいね！！！")
     */
    public $maker_url;
}

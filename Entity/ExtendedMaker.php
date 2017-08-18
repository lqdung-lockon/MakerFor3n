<?php
/**
 * Created by PhpStorm.
 * User: lqdung
 * Date: 8/18/2017
 * Time: 1:42 PM
 */

namespace Plugin\Maker\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="extended_maker")
 */
class ExtendedMaker extends Maker
{
    protected $discriminator_type = 'extendedmaker';

    /**
     * @Column(name="extended_parameter", type="string")
     */
    public $extendedParameter;

    /**
     * Set extendedParameter
     *
     * @param string $extendedParameter
     *
     * @return $this
     */
    public function setExtendedParameter($extendedParameter)
    {
        $this->extendedParameter = $extendedParameter;

        return $this;
    }

    /**
     * Get extendedParameter
     *
     * @return string
     */
    public function getExtendedParameter()
    {
        return $this->extendedParameter;
    }
}

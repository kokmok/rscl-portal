<?php
/**
 * Created by PhpStorm.
 * User: jona
 * Date: 28/09/17
 * Time: 14:45
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
trait MigrableTrait
{
    /**
     * @var integer
     * @ORM\Column(type="integer",nullable=true)
     */
    private $oldId;

    /**
     * Set oldId
     *
     * @param integer $oldId
     *
     * @return $this
     */
    public function setOldId($oldId)
    {
        $this->oldId = $oldId;

        return $this;
    }

    /**
     * Get oldId
     *
     * @return integer
     */
    public function getOldId()
    {
        return $this->oldId;
    }
}
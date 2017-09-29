<?php
/**
 * Created by PhpStorm.
 * User: jona
 * Date: 28/09/17
 * Time: 14:57
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

Trait HasPicture
{
    /**
     * @var Picture
     * @ORM\OneToOne(targetEntity="Picture",cascade={"all"})
     */
    private $picture;

    /**
     * @return Picture
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param Picture $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
        return $this;
    }
    
    
}
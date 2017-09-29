<?php
/**
 * Created by PhpStorm.
 * User: jona
 * Date: 28/09/17
 * Time: 15:20
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

trait HasNationality
{
    /**
     * @var Nationality
     * @ORM\ManyToOne(targetEntity="Nationality")
     * 
     */
    private $nationality;

    /**
     * @return Nationality
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @param Nationality $nationality
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
        return $this;
    }
    
    
}
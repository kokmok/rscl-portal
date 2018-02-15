<?php
/**
 * Created by PhpStorm.
 * User: jona
 * Date: 16/01/18
 * Time: 14:31
 */

namespace AppBundle\Search;


use Doctrine\ORM\Mapping\ManyToMany;

class TeamFilterModel
{

    /**
     * @var Roster[]
     */
    private $rosters;

    /**
     * @return Roster[]
     */
    public function getRosters()
    {
        return $this->rosters;
    }

    /**
     * @param Roster[] $rosters
     */
    public function setRosters(array $rosters)
    {
        $this->rosters = $rosters;
        return $this;
    }
    
    
    
    

}
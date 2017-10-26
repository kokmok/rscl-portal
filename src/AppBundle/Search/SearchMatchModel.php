<?php
/**
 * Created by PhpStorm.
 * User: jona
 * Date: 24/10/17
 * Time: 14:25
 */

namespace AppBundle\Search;


use AppBundle\Entity\Arbitre;
use AppBundle\Entity\Coach;
use AppBundle\Entity\Player;
use AppBundle\Entity\Saison;

class SearchMatchModel
{
    /**
     * @var Saison
     */
    private $saison;

    /**
     * @var Player
     */
    private $player;

    /**
     * @var Arbitre
     */
    private $referee;

    /**
     * @var Coach
     */
    private $coach;

    /**
     * @return Saison
     */
    public function getSaison()
    {
        return $this->saison;
    }

    /**
     * @param Saison $saison
     */
    public function setSaison(Saison $saison = null)
    {
        $this->saison = $saison;
        return $this;
    }

    /**
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param Player $player
     */
    public function setPlayer(Player $player = null)
    {
        $this->player = $player;
        return $this;
    }

    /**
     * @return Arbitre
     */
    public function getReferee()
    {
        return $this->referee;
    }

    /**
     * @param Arbitre $referee
     */
    public function setReferee(Arbitre $referee = null)
    {
        $this->referee = $referee;
        return $this;
    }

    /**
     * @return Coach
     */
    public function getCoach()
    {
        return $this->coach;
    }

    /**
     * @param Coach $coach
     */
    public function setCoach(Coach $coach)
    {
        $this->coach = $coach;
        return $this;
    }
    
    

    
    
}
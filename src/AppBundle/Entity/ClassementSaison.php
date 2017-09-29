<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClassementSaison
 *
 * @ORM\Table(name="classement_saison")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClassementSaisonRepository")
 */
class ClassementSaison
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="played", type="integer", nullable=true)
     */
    private $played;

    /**
     * @var int
     *
     * @ORM\Column(name="won", type="integer")
     */
    private $won;

    /**
     * @var int
     *
     * @ORM\Column(name="lost", type="integer")
     */
    private $lost;

    /**
     * @var int
     *
     * @ORM\Column(name="draw", type="integer")
     */
    private $draw;

    /**
     * @var int
     *
     * @ORM\Column(name="goalsScored", type="integer")
     */
    private $goalsScored;

    /**
     * @var int
     *
     * @ORM\Column(name="goalsAgainst", type="integer")
     */
    private $goalsAgainst;

    /**
     * @var int
     *
     * @ORM\Column(name="points", type="integer")
     */
    private $points;

    /**
     * @var Team
     * @ORM\ManyToOne(targetEntity="team")
     */
    private $team;

    /**
     * @var string
     * @ORM\Column(type="string",length=255)
     */
    private $teamName;
    /**
     * @var Saison
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Saison")
     */
    private $saison;
    
    use MigrableTrait;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set played
     *
     * @param integer $played
     *
     * @return ClassementSaison
     */
    public function setPlayed($played)
    {
        $this->played = $played;

        return $this;
    }

    /**
     * Get played
     *
     * @return int
     */
    public function getPlayed()
    {
        return $this->played;
    }

    /**
     * Set won
     *
     * @param integer $won
     *
     * @return ClassementSaison
     */
    public function setWon($won)
    {
        $this->won = $won;

        return $this;
    }

    /**
     * Get won
     *
     * @return int
     */
    public function getWon()
    {
        return $this->won;
    }

    /**
     * Set lost
     *
     * @param integer $lost
     *
     * @return ClassementSaison
     */
    public function setLost($lost)
    {
        $this->lost = $lost;

        return $this;
    }

    /**
     * Get lost
     *
     * @return int
     */
    public function getLost()
    {
        return $this->lost;
    }

    /**
     * Set draw
     *
     * @param integer $draw
     *
     * @return ClassementSaison
     */
    public function setDraw($draw)
    {
        $this->draw = $draw;

        return $this;
    }

    /**
     * Get draw
     *
     * @return int
     */
    public function getDraw()
    {
        return $this->draw;
    }

    /**
     * Set goalsScored
     *
     * @param integer $goalsScored
     *
     * @return ClassementSaison
     */
    public function setGoalsScored($goalsScored)
    {
        $this->goalsScored = $goalsScored;

        return $this;
    }

    /**
     * Get goalsScored
     *
     * @return int
     */
    public function getGoalsScored()
    {
        return $this->goalsScored;
    }

    /**
     * Set goalsAgainst
     *
     * @param integer $goalsAgainst
     *
     * @return ClassementSaison
     */
    public function setGoalsAgainst($goalsAgainst)
    {
        $this->goalsAgainst = $goalsAgainst;

        return $this;
    }

    /**
     * Get goalsAgainst
     *
     * @return int
     */
    public function getGoalsAgainst()
    {
        return $this->goalsAgainst;
    }

    /**
     * Set points
     *
     * @param integer $points
     *
     * @return ClassementSaison
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set team
     *
     * @param \AppBundle\Entity\team $team
     *
     * @return ClassementSaison
     */
    public function setTeam(\AppBundle\Entity\team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \AppBundle\Entity\team
     */
    public function getTeam()
    {
        return $this->team;
    }

    

    /**
     * Set teamName
     *
     * @param string $teamName
     *
     * @return ClassementSaison
     */
    public function setTeamName($teamName)
    {
        $this->teamName = $teamName;

        return $this;
    }

    /**
     * Get teamName
     *
     * @return string
     */
    public function getTeamName()
    {
        return $this->teamName;
    }

    /**
     * Set saison
     *
     * @param \AppBundle\Entity\Saison $saison
     *
     * @return ClassementSaison
     */
    public function setSaison(\AppBundle\Entity\Saison $saison = null)
    {
        $this->saison = $saison;

        return $this;
    }

    /**
     * Get saison
     *
     * @return \AppBundle\Entity\Saison
     */
    public function getSaison()
    {
        return $this->saison;
    }
}

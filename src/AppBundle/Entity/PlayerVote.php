<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerVote
 *
 * @ORM\Table(name="player_vote")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayerVoteRepository")
 */
class PlayerVote
{
    use MigrableTrait;
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
     * @ORM\Column(name="cote", type="float", nullable=true)
     */
    private $cote;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrVotes", type="integer")
     */
    private $nbrVotes;

    /**
     * @var int
     *
     * @ORM\Column(name="minutesPlayed", type="integer")
     */
    private $minutesPlayed;

    /**
     * @var Player
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Player")
     * 
     */
    private $player;

    /**
     * @var MatchGame
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MatchGame",inversedBy="votes")
     */
    private $match;

    /**
     * @var float
     * @ORM\Column(type="float",nullable=true)
     */
    private $averageCote;

   

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
     * Set cote
     *
     * @param integer $cote
     *
     * @return PlayerVote
     */
    public function setCote($cote)
    {
        $this->cote = $cote;

        return $this;
    }

    /**
     * Get cote
     *
     * @return int
     */
    public function getCote()
    {
        return $this->cote;
    }

    /**
     * Set nbrVotes
     *
     * @param integer $nbrVotes
     *
     * @return PlayerVote
     */
    public function setNbrVotes($nbrVotes)
    {
        $this->nbrVotes = $nbrVotes;

        return $this;
    }

    /**
     * Get nbrVotes
     *
     * @return int
     */
    public function getNbrVotes()
    {
        return $this->nbrVotes;
    }

    /**
     * Set minutesPlayed
     *
     * @param integer $minutesPlayed
     *
     * @return PlayerVote
     */
    public function setMinutesPlayed($minutesPlayed)
    {
        $this->minutesPlayed = $minutesPlayed;

        return $this;
    }

    /**
     * Get minutesPlayed
     *
     * @return int
     */
    public function getMinutesPlayed()
    {
        return $this->minutesPlayed;
    }

   

    /**
     * Set player
     *
     * @param \AppBundle\Entity\Player $player
     *
     * @return PlayerVote
     */
    public function setPlayer(\AppBundle\Entity\Player $player = null)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get player
     *
     * @return \AppBundle\Entity\Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set match
     *
     * @param \AppBundle\Entity\MatchGame $match
     *
     * @return PlayerVote
     */
    public function setMatch(\AppBundle\Entity\MatchGame $match = null)
    {
        $this->match = $match;

        return $this;
    }

    /**
     * Get match
     *
     * @return \AppBundle\Entity\MatchGame
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * Set saison
     *
     * @param \AppBundle\Entity\Saison $saison
     *
     * @return PlayerVote
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

    /**
     * Set averageCote
     *
     * @param float $averageCote
     *
     * @return PlayerVote
     */
    public function setAverageCote($averageCote)
    {
        $this->averageCote = $averageCote;

        return $this;
    }

    /**
     * Get averageCote
     *
     * @return float
     */
    public function getAverageCote()
    {
        return $this->averageCote;
    }
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * MatchGame
 *
 * @ORM\Table(name="match_game")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MatchGameRepository")
 */
class MatchGame
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
     * @ORM\Column(name="venue", type="integer", nullable=true)
     */
    private $venue;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="scoreHomeFinal", type="smallint", nullable=true)
     */
    private $scoreHomeFinal;

    /**
     * @var int
     *
     * @ORM\Column(name="scoreAwayFinal", type="smallint", nullable=true)
     */
    private $scoreAwayFinal;

    /**
     * @var int
     *
     * @ORM\Column(name="scoreHomeProlong", type="smallint", nullable=true)
     */
    private $scoreHomeProlong;
    
    /**
     * @var int
     *
     * @ORM\Column(name="scoreHomePen", type="smallint", nullable=true)
     */
    private $scoreHomePen;

    /**
     * @var int
     *
     * @ORM\Column(name="scoreAwayProlong", type="smallint", nullable=true)
     */
    private $scoreAwayProlong;
    
    /**
     * @var int
     *
     * @ORM\Column(name="scoreAwayPen", type="smallint", nullable=true)
     */
    private $scoreAwayPen;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var Competition
     * @ORM\ManyToOne(targetEntity="Competition")
     */
    private $competition;

    /**
     * @var Arbitre
     * @ORM\ManyToOne(targetEntity="Arbitre")
     */
    private $arbitre;

    /**
     * @var Saison
     * @ORM\ManyToOne(targetEntity="Saison")
     */
    private $saison;

    /**
     * @var Team
     * @ORM\ManyToOne(targetEntity="Team")
     */
    private $homeTeam;
    
    /**
     * @var Team
     * @ORM\ManyToOne(targetEntity="Team")
     */
    private $awayTeam;

    /**
     * @var Coach
     * @ORM\ManyToOne(targetEntity="Coach")
     */
    private $coach;

    /**
     * @var MatchEvent[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MatchEvent",mappedBy="match")
     */
    private $events;

    /**
     * @var Player[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Player")
     */
    private $players;

    /**
     * @var PlayerVote
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PlayerVote",mappedBy="match")
     * @ORM\OrderBy({"averageCote" = "DESC"})
     */
    private $votes;
    
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
     * Set venue
     *
     * @param integer $venue
     *
     * @return MatchGame
     */
    public function setVenue($venue)
    {
        $this->venue = $venue;

        return $this;
    }

    /**
     * Get venue
     *
     * @return int
     */
    public function getVenue()
    {
        return $this->venue;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return MatchGame
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return MatchGame
     */
    public function setDate($date)
    {
        if (is_string($date)){
            $date = new \DateTime($date);
        }
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set scoreHomeFinal
     *
     * @param integer $scoreHomeFinal
     *
     * @return MatchGame
     */
    public function setScoreHomeFinal($scoreHomeFinal)
    {
        $this->scoreHomeFinal = $scoreHomeFinal;

        return $this;
    }

    /**
     * Get scoreHomeFinal
     *
     * @return int
     */
    public function getScoreHomeFinal()
    {
        return $this->scoreHomeFinal;
    }

    /**
     * Set scoreAwayFinal
     *
     * @param integer $scoreAwayFinal
     *
     * @return MatchGame
     */
    public function setScoreAwayFinal($scoreAwayFinal)
    {
        $this->scoreAwayFinal = $scoreAwayFinal;

        return $this;
    }

    /**
     * Get scoreAwayFinal
     *
     * @return int
     */
    public function getScoreAwayFinal()
    {
        return $this->scoreAwayFinal;
    }

    /**
     * Set scoreHomeProlong
     *
     * @param integer $scoreHomeProlong
     *
     * @return MatchGame
     */
    public function setScoreHomeProlong($scoreHomeProlong)
    {
        $this->scoreHomeProlong = $scoreHomeProlong;

        return $this;
    }

    /**
     * Get scoreHomeProlong
     *
     * @return int
     */
    public function getScoreHomeProlong()
    {
        return $this->scoreHomeProlong;
    }

    /**
     * Set scoreAwayProlong
     *
     * @param integer $scoreAwayProlong
     *
     * @return MatchGame
     */
    public function setScoreAwayProlong($scoreAwayProlong)
    {
        $this->scoreAwayProlong = $scoreAwayProlong;

        return $this;
    }

    /**
     * Get scoreAwayProlong
     *
     * @return int
     */
    public function getScoreAwayProlong()
    {
        return $this->scoreAwayProlong;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return MatchGame
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set competition
     *
     * @param \AppBundle\Entity\competition $competition
     *
     * @return MatchGame
     */
    public function setCompetition(\AppBundle\Entity\competition $competition = null)
    {
        $this->competition = $competition;

        return $this;
    }

    /**
     * Get competition
     *
     * @return \AppBundle\Entity\competition
     */
    public function getCompetition()
    {
        return $this->competition;
    }

    /**
     * Set arbitre
     *
     * @param \AppBundle\Entity\Arbitre $arbitre
     *
     * @return MatchGame
     */
    public function setArbitre(\AppBundle\Entity\Arbitre $arbitre = null)
    {
        $this->arbitre = $arbitre;

        return $this;
    }

    /**
     * Get arbitre
     *
     * @return \AppBundle\Entity\Arbitre
     */
    public function getArbitre()
    {
        return $this->arbitre;
    }

    /**
     * Set saison
     *
     * @param \AppBundle\Entity\Saison $saison
     *
     * @return MatchGame
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
     * Set homeTeam
     *
     * @param \AppBundle\Entity\Team $homeTeam
     *
     * @return MatchGame
     */
    public function setHomeTeam(\AppBundle\Entity\Team $homeTeam = null)
    {
        $this->homeTeam = $homeTeam;

        return $this;
    }

    /**
     * Get homeTeam
     *
     * @return \AppBundle\Entity\Team
     */
    public function getHomeTeam()
    {
        return $this->homeTeam;
    }

    public function getTitle(){
        return $this->homeTeam->__toString().' - '.$this->awayTeam->__toString();
    }
    /**
     * Set awayTeam
     *
     * @param \AppBundle\Entity\Team $awayTeam
     *
     * @return MatchGame
     */
    public function setAwayTeam(\AppBundle\Entity\Team $awayTeam = null)
    {
        $this->awayTeam = $awayTeam;

        return $this;
    }

    /**
     * Get awayTeam
     *
     * @return \AppBundle\Entity\Team
     */
    public function getAwayTeam()
    {
        return $this->awayTeam;
    }

    /**
     * Set coach
     *
     * @param \AppBundle\Entity\Coach $coach
     *
     * @return MatchGame
     */
    public function setCoach(\AppBundle\Entity\Coach $coach = null)
    {
        $this->coach = $coach;

        return $this;
    }

    /**
     * Get coach
     *
     * @return \AppBundle\Entity\Coach
     */
    public function getCoach()
    {
        return $this->coach;
    }



    /**
     * Set scoreHomePen
     *
     * @param integer $scoreHomePen
     *
     * @return MatchGame
     */
    public function setScoreHomePen($scoreHomePen)
    {
        $this->scoreHomePen = $scoreHomePen;

        return $this;
    }

    /**
     * Get scoreHomePen
     *
     * @return integer
     */
    public function getScoreHomePen()
    {
        return $this->scoreHomePen;
    }

    /**
     * Set scoreAwayPen
     *
     * @param integer $scoreAwayPen
     *
     * @return MatchGame
     */
    public function setScoreAwayPen($scoreAwayPen)
    {
        $this->scoreAwayPen = $scoreAwayPen;

        return $this;
    }

    /**
     * Get scoreAwayPen
     *
     * @return integer
     */
    public function getScoreAwayPen()
    {
        return $this->scoreAwayPen;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add event
     *
     * @param \AppBundle\Entity\MatchEvent $event
     *
     * @return MatchGame
     */
    public function addEvent(\AppBundle\Entity\MatchEvent $event)
    {
        $this->events[] = $event;
       

        return $this;
    }

    /**
     * Remove event
     *
     * @param \AppBundle\Entity\MatchEvent $event
     */
    public function removeEvent(\AppBundle\Entity\MatchEvent $event)
    {
        $this->events->removeElement($event);
        if ($event->getType() === MatchEvent::TYPE_GOAL)
        {
            $this->removeGoal($event);
        }
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Add player
     *
     * @param \AppBundle\Entity\Player $player
     *
     * @return MatchGame
     */
    public function addPlayer(\AppBundle\Entity\Player $player)
    {
        $this->players[] = $player;

        return $this;
    }

    /**
     * Remove player
     *
     * @param \AppBundle\Entity\Player $player
     */
    public function removePlayer(\AppBundle\Entity\Player $player)
    {
        $this->players->removeElement($player);
    }

    /**
     * Get players
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Add vote
     *
     * @param \AppBundle\Entity\PlayerVote $vote
     *
     * @return MatchGame
     */
    public function addVote(\AppBundle\Entity\PlayerVote $vote)
    {
        $this->votes[] = $vote;

        return $this;
    }

    /**
     * Remove vote
     *
     * @param \AppBundle\Entity\PlayerVote $vote
     */
    public function removeVote(\AppBundle\Entity\PlayerVote $vote)
    {
        $this->votes->removeElement($vote);
    }

    /**
     * Get votes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVotes()
    {
        return $this->votes;
    }
    
    public function addGoal(MatchEvent $event){
        if (!$event->getType() === MatchEvent::TYPE_GOAL){
            throw new \Exception('Goal event must be type : '.MatchEvent::TYPE_GOAL);
        }
        if ($event->getTeam() !== null){
          if ($event->getTeam() === $this->homeTeam) {
                $this->scoreHomeFinal ++;
          }
          else {
              $this->scoreAwayFinal ++;
          }
        }else {//Si l'event n'a pas d'équipe c'est probablement que le standard a encaissé.
            if ($this->homeTeam->getOldId() == 1){
                $this->scoreAwayFinal ++;
            }
            else{
                $this->scoreHomeFinal ++;
            }
            
        }
        
    }
    public function removeGoal(MatchEvent $event){
        if (!$event->getType() === MatchEvent::TYPE_GOAL){
            throw new \Exception('Goal event must be type : '.MatchEvent::TYPE_GOAL);
        }
        if ($event->getTeam() !== null){
          if ($event->getTeam() === $this->homeTeam) {
                $this->scoreHomeFinal --;
          }
          else {
              $this->scoreAwayFinal --;
          }
        }else {//Si l'event n'a pas d'équipe c'est probablement que le standard n'a pas encaissé.
            if ($this->homeTeam->getOldId() == 1){
                $this->scoreAwayFinal --;
            }
            else{
                $this->scoreHomeFinal --;
            }
            
        }
        
    }
    
    public function getScore(){
        return $this->scoreHomeFinal.' - '.$this->scoreAwayFinal;
    }
    
    public function getStandardGoals(){
        return $this->homeTeam->getOldId() === 1 ? $this->scoreHomeFinal : $this->scoreAwayFinal; 
    }
    
    public function getEnemyGoals(){
        return $this->homeTeam->getOldId() === 1 ? $this->scoreAwayFinal : $this->scoreHomeFinal; 
    }
    
    public function isVictory(){
        return $this->getStandardGoals() > $this->getEnemyGoals();
    }
    
    public function isDefeat(){
        return $this->getStandardGoals() < $this->getEnemyGoals();
    }
    
    public function isDraw(){
        return $this->getStandardGoals() == $this->getEnemyGoals();
    }
}

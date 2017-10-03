<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MatchEvent;
use AppBundle\Form\MatchEventType;
use AppBundle\Entity\MatchGame;
use AppBundle\Repository\MatchGameRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->get('doctrine.orm.default_entity_manager');
        $previousMatches = $em->getRepository('AppBundle:MatchGame')->findLast();
        $nextMatch = $em->getRepository('AppBundle:MatchGame')->findNext();
        
        $bestScorersEvents = $em->getRepository('AppBundle:MatchEvent')->findBestScorersEvent();
        $bestScorersEventsJupiler = $em->getRepository('AppBundle:MatchEvent')->findBestScorersEventJupiler();
        $bestScorersEventsAllTime = $em->getRepository('AppBundle:MatchEvent')->findBestScorersEventAllTime();
        
        $firstSeason = $this->get('doctrine.orm.default_entity_manager')->getRepository('AppBundle:Saison')->findOneBy([],['name'=>'ASC']);
        
//        dump($bestScorersEvents);
//        die();
//        $season = $em->getRepository('AppBundle:Saison')->findOneBy(['running'=>true]);
        $matchEventType = null;
        if (null !== $nextMatch){
            $matchEvent = new MatchEvent();
            $matchEvent->setMatch($nextMatch);
            $matchEventType = $this->createForm(MatchEventType::class,$matchEvent);
        }
        
        
        
        return $this->render('pages/home.html.twig', [
            'firstSeason'=>$firstSeason,
            'matchEventForm'=>$matchEventType !== null ? $matchEventType->createView() : null,
            'previousMatches'=>$previousMatches,
            'nextMatches'=>$nextMatch,
            'bestScorers'=>$bestScorersEvents,
            'bestScorersJup'=>$bestScorersEventsJupiler,
            'bestScorersAllTime'=>$bestScorersEventsAllTime,
        ]);
    }

    /**
     * @Route("/match/{id}",name="view_match")
     */
    public function matchAction(MatchGame $matchGame){
        
        $classement = $this->get('doctrine.orm.default_entity_manager')->getRepository('AppBundle:ClassementSaison')->findBy(['saison'=>$matchGame->getSaison()],['points'=>'DESC']);
        $bestScorersEvents = $this->get('doctrine.orm.default_entity_manager')->getRepository('AppBundle:MatchEvent')->findBestScorersEventBySaison($matchGame->getSaison());
        $bestScorersEventsJup = $this->get('doctrine.orm.default_entity_manager')->getRepository('AppBundle:MatchEvent')->findBestScorersEventJupilerBySaison($matchGame->getSaison());


        return $this->render('pages/match.html.twig',['bestScorer'=>$bestScorersEvents,'bestScorerJup'=>$bestScorersEventsJup,'match'=>$matchGame,'classement'=>$classement]);
        
        
    }
}

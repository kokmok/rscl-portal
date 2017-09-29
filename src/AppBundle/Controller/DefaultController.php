<?php

namespace AppBundle\Controller;

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
        
//        dump($bestScorersEvents);
//        die();
//        $season = $em->getRepository('AppBundle:Saison')->findOneBy(['running'=>true]);
        
        
        
        
        
        return $this->render('pages/home.html.twig', [
            'previousMatches'=>$previousMatches,
            'nextMatches'=>$nextMatch,
            'bestScorers'=>$bestScorersEvents,
            'bestScorersJup'=>$bestScorersEventsJupiler,
            'bestScorersAllTime'=>$bestScorersEventsAllTime,
        ]);
    }
}

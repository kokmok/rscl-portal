<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class SeoController extends Controller
{
    /**
     * 
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(path="/sitemap.xml",name="sitemap")
     */
    public function siteMapAction()
    {
        $matchs = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:MatchGame')->findAll();
        return $this->render('pages/sitemap.xml.twig', array('matchs' => $matchs));
    }

    /**
     * @Route(path="/robot.txt",name="robot")
     */
    public function robotTxtAction(){
        return $this->render('pages/robot.txt.twig');
    }
}

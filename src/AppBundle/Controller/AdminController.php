<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MatchGame;
use AppBundle\Form\MatchGameType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/admin/new-match", name="new_match")
     */
    public function newMatchAction(Request $request)
    {
        $match = new MatchGame();
        $form = $this->createForm(MatchGameType::class,$match);
        if ($form->handleRequest($request)->isValid()){
            $em = $this->get('doctrine.orm.default_entity_manager');
            $em->persist($match);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }
        
        return $this->render('pages/simple-form.html.twig', array('form' => $form->createView(),'title'=>'Nouveau match'));
    }
}

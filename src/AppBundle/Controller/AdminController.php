<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MatchEvent;
use AppBundle\Entity\MatchGame;
use AppBundle\Entity\Player;
use AppBundle\Entity\Team;
use AppBundle\Form\MatchEventType;
use AppBundle\Form\MatchGameType;
use AppBundle\Form\PlayerType;
use AppBundle\Form\TeamType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse|Response
     * @Route("/admin/new-match", name="new_match")
     */
    public function newMatchAction(Request $request)
    {
        $em = $this->get('doctrine.orm.default_entity_manager');
        $teamCompetitionRepository = $em->getRepository(Team::class);
        $match = new MatchGame();
        $form = $this->createForm(MatchGameType::class, $match, [
            'preferred_teams' => $teamCompetitionRepository->getProLeagueATeams()
        ]);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($match);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('pages/simple-form.html.twig', array('form' => $form->createView(), 'title' => 'Nouveau match'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     * @Route("/admin/edit-match/{id}", name="edit_match")
     */
    public function editMatchAction(MatchGame $match, Request $request)
    {
//        $match = new MatchGame();
        $form = $this->createForm(MatchGameType::class, $match);
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->get('doctrine.orm.default_entity_manager');
            $em->persist($match);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }

        return $this->render('pages/simple-form.html.twig', array('form' => $form->createView(), 'title' => 'Nouveau match'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     * @Route("/admin/add-match-event/{id}", name="add_match_event")
     */
    public function addMatchEventAction(MatchGame $match, Request $request)
    {
        $redirectUrl = null !== $request->query->get('redirectUrl') ? $request->query->get('redirectUrl') : $request->getRequestUri();

        $matchEvent = new MatchEvent();
        $matchEvent->setMatch($match);
        $matchEventForm = $this->createForm(MatchEventType::class, $matchEvent);

        if ($matchEventForm->handleRequest($request)->isValid()) {
            $em = $this->get('doctrine.orm.default_entity_manager');
            $em->persist($matchEvent);
            if ($matchEvent->getType() === MatchEvent::TYPE_GOAL) {
                $match->addGoal($matchEvent);
                $em->persist($match);
            }
            $em->flush();

        } else {
            //@TODO add flashbag
        }
        return $this->redirect($redirectUrl);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     * @Route("/admin/edit-player/{id}", name="edit-player")
     */
    public function editPlayerAction(Player $player, Request $request)
    {
        $form = $this->createForm(PlayerType::class, $player);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->get('doctrine.orm.default_entity_manager');
            $em->persist($player);
            $em->flush();
            //@TODO Add flashbag
            return $this->redirect($request->getRequestUri());
        }
        return $this->render('pages/simple-form.html.twig', ['form' => $form->createView(), 'title' => 'Edit joueur']);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     * @Route("/admin/edit-team/{id}", name="edit-team")
     */
    public function editTeamAction(Team $team, Request $request)
    {
        $form = $this->createForm(TeamType::class, $team);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->get('doctrine.orm.default_entity_manager');
            $em->persist($team);
            $em->flush();
            //@TODO Add flashbag
            return $this->redirect($request->getRequestUri());
        }
        return $this->render('pages/simple-form.html.twig', [
            'form' => $form->createView(),
            'title' => 'Edit équipe'
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     * @Route("/admin/new/team", name="new_team")
     */
    public function newTeamAction(Request $request)
    {
        $em = $this->get('doctrine.orm.default_entity_manager');
        $team = new Team();
        $form = $this->createForm(TeamType::class, $team);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($team);
            $em->flush();
            $this->addFlash('success', 'New team added successfully');

            return $this->redirectToRoute('entity_list', ['entityName' => 'team']);
        }

        return $this->render('pages/simple-form.html.twig', [
            'form' => $form->createView(),
            'title' => 'Nouvelle équipe'
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     * @Route("/admin/new/player", name="new_player")
     */
    public function newPlayerAction(Request $request)
    {
        $em = $this->get('doctrine.orm.default_entity_manager');
        $player = new Player();
        $form = $this->createForm(PlayerType::class, $player);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($player);
            $em->flush();
            $this->addFlash('success', 'New player added successfully');

            return $this->redirectToRoute('entity_list', ['entityName' => 'player']);
        }

        return $this->render('pages/simple-form.html.twig', [
            'form' => $form->createView(),
            'title' => 'Nouveau joueur'
        ]);
    }
}

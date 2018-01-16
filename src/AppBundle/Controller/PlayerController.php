<?php

namespace AppBundle\Controller;

use AppBundle\Search\TeamFilterModel;
use AppBundle\Search\TeamFilterType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\HttpResponse;
use AppBundle\Entity\Player;
use Carbon\Carbon;

class PlayerController extends Controller
{
    /**
     * @Route("/player/{id}",name="view_player")
     * @param Player $player
     */
    public function playerAction(Player $player)
    {
        $birthDate = Carbon::createFromTimestamp($player->getBirthDate()->getTimestamp());

        return $this->render('pages/player.html.twig', [
            'player' => $player,
            'aged' => $birthDate->diffInYears(),
        ]);
    }

    /**
     * @Route("/players", name="players_list")
     * @param Request $request
     */
    public function playersAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $playerRepository = $em->getRepository('AppBundle:Player');
        $rosterRepository = $em->getRepository('AppBundle:Roster');
        $rosters = $rosterRepository->findAllActive();
        $players = $playerRepository->findAllSorted($rosters);
        $searchPlayerModel = new TeamFilterModel();
        $form = $this->createForm(TeamFilterType::class, $searchPlayerModel);

        return $this->render('pages/players.html.twig', [
            'form' => $form->createView(),
            'players' => $players,
            'rosters' => $rosters,
        ]);
    }
}
<?php

namespace AppBundle\Command;

use AppBundle\Entity\Player;
use AppBundle\Entity\Roster;
use AppBundle\Entity\Team;
use AppBundle\Repository\PlayerRepository;
use AppBundle\Repository\RosterRepository;
use AppBundle\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class InitRosterCommand
 *
 * Classe destinée à l'initialisation de la table Roster
 * et à l'assignation des joueurs de la base de données.
 * Devra être supprimée dès que possible
 *
 * @package AppBundle\Command
 */
class InitRosterCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:init-roster')
            ->setDescription("Crée les différents noyaux/états ('rosters') et assigne les joueurs déjà présents en base de données");
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.default_entity_manager');

        $rostersData = [
            'A' => 'Noyau A',
            'B' => 'Noyau B',
            'C' => 'Noyau C',
            'U21' => 'Jeunes -21 ans',
            'L' => 'Prêté', // à un autre club (joueur en prêt = un flag à créer)
            'OLD' => 'Ancien',
        ];

        $playersData = [
            'A' => [2258, 2261, 2529, 2572, 2607, 2639, 2654, 2660, 2664, 2665, 2674, 2680,
                2684, 2686, 2689, 2690, 2691, 2692, 2693, 2694, 2695, 2696, 2697, 2698,
                2699, 2700],
            'B' => [2650, 2656, 2657, 2670,],
            // 2650 Badibanga ok
            // 2656 Tetteh ?
            // 2657 Gobitaka ok
            // 2670 Deom ok
            'C' => [2683,],
            // 2683 Mladenovic, ?
            'U21' => [],
            'L' => [2642, 2652, 2676, 2679, 2688,],
            // 2642 R.Mmaee, Waasland-Beveren
            // 2652 Dossevi, FC Metz
            // 2676 Raman, Fortuna Dusseldorf
            // 2679 Belfodil, Werder Bremen
            // 2688 Bolingi, Royal Excel Mouscron
        ];

        $rosters = [];

        /**
         * @var RosterRepository $rosterRepository
         */
        $rosterRepository = $em->getRepository('AppBundle:Roster');
        /**
         * @var PlayerRepository $playerRepository
         */
        $playerRepository = $em->getRepository('AppBundle:Player');
        /**
         * @var TeamRepository $teamRepository
         */
        $teamRepository = $em->getRepository('AppBundle:Team');

        $output->writeln("Renaming Mouscron-Péruwelz to Royal Excel Mouscron...");
        $team = $teamRepository->findOneByName('Mouscron-Péruwelz');
        $team->setName('Royal Excel Mouscron');
        $em->persist($team);
        $output->writeln("Creating FC Metz...");
        $team = (new Team())->setName('FC Metz');
        $em->persist($team);
        $output->writeln("Creating Fortuna Düsseldorf...");
        $team = (new Team())->setName('Fortuna Düsseldorf');
        $em->persist($team);
        $output->writeln("Creating Werder Bremen...");
        $team = (new Team())->setName('Werder Bremen');
        $em->persist($team);
        $em->flush();

        $loanedToTeams = [
            2642 => 'Waasland-Beveren',
            2652 => 'FC Metz',
            2676 => 'Fortuna Düsseldorf',
            2679 => 'Werder Bremen',
            2688 => 'Royal Excel Mouscron',
        ];

        foreach ($loanedToTeams as $playerId => $teamName) {
            $player = $playerRepository->find($playerId);
            $team = $teamRepository->findOneByName($teamName);
            $output->writeln("Assigning {$player->getFullName()} to team {$team->getName()}...");
            $player->setTeam($team);
            $em->persist($player);
        }
        $em->flush();

        foreach ($rostersData as $label => $name) {
            $output->writeln("Creating roster {$name} ({$label})");
            $roster = (new Roster)->setName($name)->setLabel($label);
            $em->persist($roster);
        }

        $output->writeln("Saving rosters...");
        $em->flush();

        $rosterObjects = $rosterRepository->findAll();
        foreach ($rosterObjects as $roster) {
            /**
             * @var Roster $roster
             */
            $rosters[$roster->getLabel()] = $roster;
        }
        unset($rosterObjects);

        // Set everyone to roster OLD
        $output->writeln("Setting everyone to roster OLD by default...");
        foreach ($playerRepository->findAll() as $player) {
            $player->setRoster($rosters['OLD']);
            $em->persist($player);
        }

        // Set exceptions
        $meteb = $playerRepository->find(2283);
        $meteb->setRoster(null);
        $em->persist($meteb);

        // Set players in active rosters
        foreach ($playersData as $rosterLabel => $rosterPlayers) {
            foreach ($rosterPlayers as $id) {
                /**
                 * load player
                 * @var Player $player
                 */
                $player = $playerRepository->find($id);
                if ($player) {
                    $player->setRoster($rosters[$rosterLabel]);
                    $output->writeln("Assigning {$player->getFullName()} to roster {$rosterLabel}");
                    //save player-roster association
                    $em->persist($player);
                }
            }
        }

        $output->writeln("Saving players...");
        $em->flush();
        $output->writeln("Saved.");
    }
}
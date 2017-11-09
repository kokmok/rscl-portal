<?php

namespace AppBundle\Command;

use AppBundle\Entity\Competition;
use AppBundle\Entity\Saison;
use AppBundle\Entity\Team;
use AppBundle\Entity\TeamCompetition;
use AppBundle\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Form\Exception\LogicException;

/**
 * Class InitTeamCompetitionCommand
 *
 * Classe destinée au remplissage initial de la table TeamCompetition en prod
 * Devra être supprimée dès que possible
 *
 * @package AppBundle\Command
 */
class InitTeamCompetitionCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:init-team-competition')
            ->setDescription("Crée les enregistrements initiaux de la table teamcompetition")
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.default_entity_manager');
        /**
         * @var TeamRepository $teamRepository
         */
        $teamRepository = $em->getRepository('AppBundle:Team');

        $teamNames = [
            "Standard de Liège",
            "KRC Genk",
            "FC Malines",
            "RSC Anderlecht",
            "KV Courtrai",
            "La Gantoise",
            "Saint-Trond",
            "SV Zulte Waregem",
            "FC Bruges",
            "Sporting Lokeren",
            "Sporting Charleroi",
            "Antwerp FC",
            "KV Ostende",
            "Waasland-Beveren",
            "Mouscron-Peruwelz",
            "AS Eupen",
        ];

        /**
         * load competition object
         * @var Competition $proLeagueA
         */
        $proLeagueA = $em->getRepository('AppBundle:Competition')->findOneByName('Championnat');

        /**
         * load season object
         * @var Saison $currentSeason
         */
        $currentSeason = $em->getRepository('AppBundle:Saison')->findOneByName('2017-2018');

        foreach ($teamNames as $name) {
            /**
             * load team objects
             * @var Team $team
             */
            $team = $teamRepository->findOneByName($name);

            // create team-competition record
            $teamCompetition = new TeamCompetition;
            $teamCompetition->setName($name);
            $teamCompetition->setTeam($team);
            $teamCompetition->setSeason($currentSeason);
            $teamCompetition->setCompetition($proLeagueA);
            $output->writeln("Preparing {$name} to be set as competing in {$proLeagueA->getName()} in {$currentSeason->getName()}");
            //save team-competition association
            $em->persist($teamCompetition);
        }

        $em->flush();
        $output->writeln("Saved.");
    }
}
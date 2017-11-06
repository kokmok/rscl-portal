<?php

namespace AppBundle\Command;

use AppBundle\Entity\MatchEvent;
use AppBundle\Entity\MatchGame;
use AppBundle\Entity\Player;
use AppBundle\Entity\PlayerVote;
use AppBundle\Repository\MatchEventRepository;
use AppBundle\Repository\MatchGameRepository;
use AppBundle\Repository\PlayerRepository;
use AppBundle\Repository\TeamRepository;
use AppBundle\Search\SearchMatchModel;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CleanupDoubleEntriesInPlayersCommand
 *
 * Classe destinée à supprimer les doublons dans la table des joueurs
 * Devra être supprimée dès que possible
 *
 * @package AppBundle\Command
 */
class CleanupDoubleEntriesInPlayersCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:cleanup-players')
            ->setDescription("Supprime les doublons dans la table des joueurs")
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.default_entity_manager');
        /**
         * @var PlayerRepository $playerRepository
         */
        $playerRepository = $em->getRepository('AppBundle:Player');
        /**
         * @var MatchEventRepository $matchEventRepository
         */
        $matchEventRepository = $em->getRepository('AppBundle:MatchEvent');
        /**
         * @var MatchGameRepository $matchGameRepository
         */
        $matchGameRepository = $em->getRepository('AppBundle:MatchGame');
        /**
         * @var MatchGameRepository $matchGameRepository
         */
        $playerVoteRepository = $em->getRepository('AppBundle:PlayerVote');

        $toDelete = [
            2425, 2426, 2427, 2428, 2429,
            2430, 2431, 2432, 2433, 2435, 2436, 2437, 2438, 2439,
            2440, 2441, 2448, 2449,
            2454,
            2588, 2589, 2590,
        ];

        foreach ($toDelete as $id) {
            $player = $playerRepository->find($id);

            if ($player) {
                $output->writeln("Deleting player {$id} ({$player->getFullName()})");
                $em->remove($player);
            } else {
                $output->writeln("Player Id not found in database: {$id}");
            }
        }
        $em->flush();

        // Tikva/Tykva merge (no potala involved)
        /**
         * @var Player $player
         */
        $player = $playerRepository->find(2583);
        $oldPlayer = $playerRepository->find(2508);

        $output->writeln("Merging Tikva and Tykva");

        $output->writeln("Merging seasons...");
        foreach($oldPlayer->getSeasons() as $season) {
            $oldPlayer->removeSeason($season);
        }
        $em->persist($oldPlayer);
        $em->flush();

        $output->writeln("Merging match events...");
        $matchEvents = $matchEventRepository->findByPlayer($oldPlayer);
        foreach($matchEvents as $matchEvent) {
            /**
             * @var MatchEvent $matchEvent
             */
            $output->writeln("Match Event {$matchEvent->getId()}");
            $matchEvent->setPlayer($player);
            $em->persist($matchEvent);
        }
        $em->flush();

        $output->writeln("Merging match games...");
        $matchGames = $matchGameRepository->findBySearch((new SearchMatchModel)->setPlayer($oldPlayer));
        foreach($matchGames as $matchGame) {
            /**
             * @var MatchGame $matchGame
             * @var Player $oldPlayer
             */
            $matchGame->addPlayer($player);
            $matchGame->removePlayer($oldPlayer);
            $em->persist($matchGame);
        }
        $em->flush();

        $playerVotes = $playerVoteRepository->findByPlayer($oldPlayer);
        foreach($playerVotes as $playerVote) {
            /**
             * @var PlayerVote $playerVote
             */
            $playerVote->setPlayer($player);
            $em->persist($playerVote);
        }
        $em->flush();

        $output->writeln("Updating {$player->getId()} ({$player->getFullName()})");
        $player->setLastName('Tikva');
        $em->persist($player);
        $em->flush();

        $output->writeln("Deleting {$oldPlayer->getId()} ({$oldPlayer->getFullName()})");
        $em->remove($oldPlayer);
        $em->flush();

        // Fai
        $oldPlayer = $playerRepository->find(2673);
        $player = $playerRepository->find(2664);
        $player->setContract($oldPlayer->getContract());
        $player->setPosition($oldPlayer->getPosition());
        $player->setTeamName($oldPlayer->getTeamName());
        $output->writeln("Updating player {$player->getId()} ({$player->getFullName()})");
        $em->persist($player);
        $output->writeln("Deleting player {$oldPlayer->getId()} ({$oldPlayer->getFullName()})");
        $em->remove($oldPlayer);

        $em->flush();
        $output->writeln("Saved.");
    }
}
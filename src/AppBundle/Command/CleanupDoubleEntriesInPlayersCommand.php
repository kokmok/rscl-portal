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
use Symfony\Component\Console\Input\InputOption;
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
    const ARGUMENT_FLUSHABLE = 'FLUSHABLE';
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:cleanup-players')
            ->addOption(self::ARGUMENT_FLUSHABLE, 'f', InputOption::VALUE_NONE)
            ->setDescription("Supprime les doublons dans la table des joueurs")
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $flushable   = true === $input->getOption(self::ARGUMENT_FLUSHABLE);
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
            177,178,179,180,181,182,183,184,185,187,188,189,190,191,192,193,200,201,206,301,304,340,341,342
        ];

        foreach ($toDelete as $id) {
            $player = $playerRepository->findOneByOldId($id);

            if ($player) {
                $output->writeln("Deleting player {$id} ({$player->getFullName()})");
                $em->remove($player);
            } else {
                $output->writeln("Player Id not found in database: {$id}");
            }
        }
        if ($flushable){
            $em->flush();
            $output->writeln('Flush removed players');
        }

        // Tikva/Tykva merge (no potala involved)
        /**
         * @var Player $player
         */
        $player = $playerRepository->findOneByOldId(259);
        $oldPlayer = $playerRepository->findOneByOldId(334);
        
        if ($oldPlayer) {


            $output->writeln("Merging Tikva and Tykva");

            $output->writeln("Merging seasons...");
            foreach ($oldPlayer->getSeasons() as $season) {
                $oldPlayer->removeSeason($season);
            }
            if ($flushable) {
                $em->persist($oldPlayer);
                $em->flush();
                $output->writeln('Flush merging seasons');
            }


            $output->writeln("Merging match events...");
            $matchEvents = $matchEventRepository->findByPlayer($oldPlayer);
            foreach ($matchEvents as $matchEvent) {
                /**
                 * @var MatchEvent $matchEvent
                 */
                $output->writeln("Match Event {$matchEvent->getId()}");
                $matchEvent->setPlayer($player);
                $em->persist($matchEvent);
            }
            if ($flushable) {

                $em->flush();
                $output->writeln('Flush merging match events');
            }

            $output->writeln("Merging match games...");
            $matchGames = $matchGameRepository->findBySearch((new SearchMatchModel)->setPlayer($oldPlayer));
            foreach ($matchGames as $matchGame) {
                /**
                 * @var MatchGame $matchGame
                 * @var Player $oldPlayer
                 */
                $matchGame->addPlayer($player);
                $matchGame->removePlayer($oldPlayer);
                $em->persist($matchGame);
            }
            if ($flushable) {
                $em->flush();
                $em->flush();
                $output->writeln('Flush merging match games');
            }


            $playerVotes = $playerVoteRepository->findByPlayer($oldPlayer);
            foreach ($playerVotes as $playerVote) {
                /**
                 * @var PlayerVote $playerVote
                 */
                $playerVote->setPlayer($player);
                $em->persist($playerVote);
            }

            $output->writeln("Updating {$player->getId()} ({$player->getFullName()})");
            $player->setLastName('Tikva');
            $em->persist($player);


            $output->writeln("Deleting {$oldPlayer->getId()} ({$oldPlayer->getFullName()})");
            $em->remove($oldPlayer);

            if ($flushable) {

                $em->flush();
                $output->writeln('Flush deleting doublon');
            }
        }

        // Fai
        $oldPlayer = $playerRepository->findOneByOldId(416);
        $player = $playerRepository->findOneByOldId(425);
        $player->setContract($oldPlayer->getContract());
        $player->setPosition($oldPlayer->getPosition());
        $player->setTeamName($oldPlayer->getTeamName());
        $matchEvents = $matchEventRepository->findBy(['player'=>$oldPlayer]);
        foreach ($matchEvents as $matchEvent){
            $matchEvent->setPlayer($player);
        }
        $playerVotes = $playerVoteRepository->findByPlayer($oldPlayer);
        foreach ($playerVotes as $playerVote) {
            /**
             * @var PlayerVote $playerVote
             */
            $playerVote->setPlayer($player);
            
        }
        
        
        
        $output->writeln("Updating player {$player->getId()} ({$player->getFullName()})");
        $em->persist($player);
        $output->writeln("Deleting player {$oldPlayer->getId()} ({$oldPlayer->getFullName()})");
        $em->remove($oldPlayer);
        
        

        if ($flushable) {
            $em->flush();
            $output->writeln("flushing fai fix.");
        }
    }
}
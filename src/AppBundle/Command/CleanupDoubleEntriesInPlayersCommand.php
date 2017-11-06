<?php

namespace AppBundle\Command;

use AppBundle\Entity\Player;
use AppBundle\Repository\TeamRepository;
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
         * @var TeamRepository $teamRepository
         */
        $playerRepository = $em->getRepository('AppBundle:Player');

        $toDelete = [
            2425, 2426, 2427, 2428, 2429,
            2430, 2431, 2432, 2433, 2435, 2436, 2437, 2438, 2439,
            2440, 2441, 2448, 2449,
            2454,
            2508,
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

        // Tikva
        $player = $playerRepository->find(2583);
        $player->setLastName('Tikva');
        $output->writeln("Updating {$player->getId()} ({$player->getFullName()})");
        $em->persist($player);

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
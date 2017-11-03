<?php

namespace AppBundle\Command;

use AppBundle\Entity\Player;
use AppBundle\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class InitNicknamesForExistingPlayersCommand
 *
 * Classe destinée à ajouter le pseudo des joueurs déjà présents en base de données
 * Devra être supprimée dès que possible
 *
 * @package AppBundle\Command
 */
class InitNicknamesForExistingPlayersCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:init-nicknames')
            ->setDescription("Crée les pseudos des joueurs déjà présents dans la base de données")
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

        $playerNicknames = [
            2256 => 'Victor Ramos',
            2263 => 'Felipe',
            2265 => 'Mehdi Carcela',
            2286 => 'Danilo',
            2310 => 'Luis De Matos',
            2332 => 'Fred',
            2369 => 'Wamberto',
            2372 => 'Almani Moreira',
            2426 => 'Dinga',
            2441 => 'Rubenilson',
            2453 => 'Vinicius',
            2503 => 'Kanu',
            2516 => 'Edmilson',
            2527 => 'Dos Santos',
            2545 => 'Zefilho',
            2546 => 'Luciano',
            2600 => 'Zeki Fryers',
            2601 => 'Phellype',
            2603 => 'Reza',
            2660 => 'Edmilson Jr',
            2698 => 'Carlinhos',
        ];

        foreach ($playerNicknames as $id => $nickName) {
            /**
             * load player object
             * @var Player $player
             */
            $player = $playerRepository->find($id);

            if ($player) {
                $output->writeln("Setting nickname '{$nickName}' to {$player->getFullName()}");
                $player->setNickName($nickName);
                $em->persist($player);
            } else {
                $output->writeln("Player Id not found in database: {$id} ({$nickName})");
            }
        }

        $em->flush();
        $output->writeln("Saved.");
    }
}
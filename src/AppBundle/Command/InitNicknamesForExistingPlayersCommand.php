<?php

namespace AppBundle\Command;

use AppBundle\Entity\Player;
use AppBundle\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
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
    const ARGUMENT_FLUSHABLE = 'FLUSHABLE';
    
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:init-nicknames')
            ->addOption(self::ARGUMENT_FLUSHABLE, 'f', InputOption::VALUE_NONE)
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
            6 => 'Victor Ramos',
            13 => 'Felipe',
            15 => 'Mehdi Carcela',
            36 => 'Danilo',
            60 => 'Luis De Matos',
            83 => 'Fred',
            121 => 'Wamberto',
            124 => 'Almani Moreira',
            205 => 'Vinicius',
            208 => 'Dinga',
            223 => 'Rubenilson',
            254 => 'Kanu',
            267 => 'Edmilson',
            278 => 'Dos Santos',
            296 => 'Zefilho',
            297 => 'Luciano',
            352 => 'Zeki Fryers',
            353 => 'Phellype',
            355 => 'Reza',
            412 => 'Edmilson Jr',
            450 => 'Carlinhos',
        ];


        foreach ($playerNicknames as $id => $nickName) {
            /**
             * load player object
             * @var Player $player
             */
            $player = $playerRepository->findOneByOldId($id);

            if ($player) {
                $output->writeln("Setting nickname '{$nickName}' to {$player->getFullName()}");
                $player->setNickName($nickName);
                $em->persist($player);
            } else {
                $output->writeln("Player Id not found in database: {$id} ({$nickName})");
            }
        }
        $flushable   = true === $input->getOption(self::ARGUMENT_FLUSHABLE);
        if ($flushable){
            $em->flush();
            $output->writeln("Saved.");    
        }

        
    }
}
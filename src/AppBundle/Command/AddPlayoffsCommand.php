<?php

namespace AppBundle\Command;

use AppBundle\Entity\Competition;
use AppBundle\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Form\Exception\LogicException;

/**
 * Class AddPlayoffsCommand
 *
 * Classe destinée à ajouter les playoffs dans la liste des compétitions
 * Devra être supprimée dès que possible
 *
 * @package AppBundle\Command
 */
class AddPlayoffsCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:add-playoffs')
            ->setDescription("Ajoute les playoffs")
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.default_entity_manager');

        $competitionNames = [
            "Pro League A - Playoffs 1",
            "Pro League A - Playoffs 2 Groupe A",
            "Pro League A - Playoffs 2 Groupe B",
            "Pro League A - Playoffs 3",
        ];

        foreach ($competitionNames as $name) {
            $competition = new Competition();
            $competition->setName($name);
            $output->writeln("Adding competition '{$name}'...");
            $em->persist($competition);
        }

        $em->flush();
        $output->writeln("Saved.");
    }
}
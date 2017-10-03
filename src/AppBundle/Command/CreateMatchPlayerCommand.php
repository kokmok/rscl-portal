<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use AppBundle\Entity\PlayerVote;

class CreateMatchPlayerCommand extends ContainerAwareCommand
{
    const FLUSH = 'FLUSH';
    
    
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:create_match_player')
            ->addOption(self::FLUSH,'f',InputOption::VALUE_NONE)
            ->setDescription('Hello PhpStorm');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.default_entity_manager');
        /**
         * @var PlayerVote[] $votes
         */
        $votes = $em->getRepository('AppBundle:PlayerVote')->findAll();
        foreach ($votes as $vote){
            $vote->getMatch()->addPlayer($vote->getPlayer());
            $output->writeln('Adding player '.$vote->getPlayer().' to match '.$vote->getMatch()->getName());
        }
        if ($input->getOption(self::FLUSH)){
            $em->flush();
        }
        
    }
}

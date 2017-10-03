<?php

namespace AppBundle\Command;

use AppBundle\Entity\PlayerVote;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class SetVoteAverageCommand extends ContainerAwareCommand
{
    const FLUSH = 'FLUSH';
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:set_vote_average')
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
            if($vote->getNbrVotes()){
                $vote->setAverageCote(round($vote->getCote()/$vote->getNbrVotes(),2));
                $output->writeln('Setting average cote to '.$vote->getAverageCote());
            }
        }
        
        if ($input->getOption(self::FLUSH)){
            $em->flush();
        }
    }
}

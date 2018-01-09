<?php

namespace AppBundle\Command;

use AppBundle\Entity\Player;
use AppBundle\Entity\Team;
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
class getOldIdCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:oldId')
            ->setDescription("transforme des id en oldId")
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
        $teamRepository = $em->getRepository('AppBundle:Team');



        $baseArray = [
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
        
        foreach ($baseArray as $key =>$value){
            $players = $playerRepository->findBy(['id'=>$value]);
            $oldIds = implode(',',array_map(function(Player $player){return $player->getOldId();},$players));
            $output->writeln("'".$key."' =>[".$oldIds.']');
        }

        $loanedToTeams = [
            2642 => 'Waasland-Beveren',
            2652 => 'FC Metz',
            2676 => 'Fortuna Düsseldorf',
            2679 => 'Werder Bremen',
            2688 => 'Royal Excel Mouscron',
        ];
        
        $teams = $teamRepository->findBy(['id'=>array_keys($loanedToTeams)]);
        $output->writeln('teams '.implode(',',array_map(function(Team $team){return $team->getOldId();},$teams)));
       
        $player = $playerRepository->find(2283);
//        
        $output->writeln('Meteb : '.$player->getOldId());
        
    }
}
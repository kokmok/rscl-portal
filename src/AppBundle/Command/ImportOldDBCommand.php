<?php

namespace AppBundle\Command;

use AppBundle\Entity\Arbitre;
use AppBundle\Entity\Picture;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportOldDBCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:import_old_dbcommand')
            ->setDescription('Hello PhpStorm');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        
       
        $pdo = new \PDO('mysql:dbname=rscl;host=localhost','root','root');
        
        
        //Arbitres
//        $sth = $pdo->exec('SELECT * FROM `archive_arbitre`');
//        $arbitresArray =  $sth->fetchAll();
//        foreach ($arbitresArray as $persoAsArray){
//            $arbitre = new Arbitre();
//            $arbitre->setOldId($persoAsArray['ID_ARBITRE'])
//                ->setFirstName($persoAsArray['NOM_ARBITRE'])
//                ->setLastName($persoAsArray['PRENOM_ARBITRE'])
//                ;
//            $picture = new Picture();
//            $picture->setPath($persoAsArray['PRENOM_ARBITRE'])
//                ;
//        }
        

    }
}

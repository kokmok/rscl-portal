<?php
/**
 * Created by PhpStorm.
 * User: jona
 * Date: 28/09/17
 * Time: 15:10
 */
namespace  AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Arbitre;
use AppBundle\Entity\ClassementSaison;
use AppBundle\Entity\Coach;
use AppBundle\Entity\Competition;
use AppBundle\Entity\MatchEvent;
use AppBundle\Entity\MatchGame;
use AppBundle\Entity\Nationality;
use AppBundle\Entity\Picture;
use AppBundle\Entity\Player;
use AppBundle\Entity\PlayerVote;
use AppBundle\Entity\Saison;
use AppBundle\Entity\Stadium;
use AppBundle\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {   
//        return;
        $pdo = new \PDO('mysql:dbname=rscl;host=localhost','root','root');

//        $sth = $pdo->prepare('SELECT * FROM `archive_nationalite`');
//        $sth->execute();
//        $oldNats =  $sth->fetchAll();
//        foreach ($oldNats as $oldNat){
//            $nationality = new Nationality();
//            $nationality->setOldId($oldNat['ID_NATIONALITE'])
//                ->setName($oldNat['LIBELLE_NATIONALITE']);
//            
//            $picture = new Picture();
//            $picture->setPath($oldNat['DRAPEAU_NATIONALITE']);
//            $nationality->setPicture($picture);
//            $manager->persist($nationality);
//        }
//        $manager->flush();
//        
//        //Arbitres
//        $natRepo = $manager->getRepository('AppBundle:Nationality');
//        $sth = $pdo->prepare('SELECT * FROM `archive_arbitre`');
//        $sth->execute();
//        $oldArbs =  $sth->fetchAll();
//        foreach ($oldArbs as $oldArb){
//            $nationality = $natRepo->findOneBy(['oldId'=>$oldArb['NATIONALITE']]);
//            $arbitre = new Arbitre();
//            $arbitre->setLastName($oldArb['NOM_ARBITRE'])
//                    ->setFirstName($oldArb['PRENOM_ARBITRE'])
//                    ->setOldId($oldArb['ID_ARBITRE'])
//                    ->setNationality($nationality)
//            ;
//            
//            
//            $manager->persist($arbitre);
//        }
//        $manager->flush();
//        
//        //Saisons
//        $sth = $pdo->prepare('SELECT * FROM `archive_saison`');
//        $sth->execute();
//        $oldSais =  $sth->fetchAll();
//        foreach ($oldSais as $oldSai){
//            $saison = new Saison();
//            $saison->setOldId($oldSai['ID_SAISON'])
//                ->setName($oldSai['LIBELLE_SAISON'])
//                ->setRunning($oldSai['EN_COURS']?true:false);
//            $manager->persist($saison);
//        }
//        $manager->flush();
//        
//        //Competitions
//        $sth = $pdo->prepare('SELECT * FROM `archive_competition`');
//        $sth->execute();
//        $oldSais =  $sth->fetchAll();
//        foreach ($oldSais as $oldSai){
//            $competition = new Competition();
//            $competition->setOldId($oldSai['ID_COMPETITION'])
//                ->setName($oldSai['LIBELLE_COMPETITION'])
//                ;
//            $manager->persist($competition);
//        }
//        $manager->flush();
//        
//        //Coaches
//        $sth = $pdo->prepare('SELECT * FROM `archive_entraineur`');
//        $sth->execute();
//        $oldSais =  $sth->fetchAll();
//        foreach ($oldSais as $oldSai){
//            $coach = new Coach();
//            $coach->setOldId($oldSai['ID_ENTRAINEUR'])
//                ->setFirstName($oldSai['PRENOM_ENTRAINEUR'])
//                ->setLastName($oldSai['NOM_ENTRAINEUR'])
//            ;
//            $manager->persist($coach);
//        }
//        $manager->flush();
//        
//        //Teams
//        $sth = $pdo->prepare('SELECT * FROM `archive_equipe`');
//        $sth->execute();
//        $oldSais =  $sth->fetchAll();
//        foreach ($oldSais as $oldSai){
//            $team = new Team();
//            $team->setOldId($oldSai['ID_EQUIPE'])
//                ->setName($oldSai['LIBELLE_EQUIPE'])
//                ;
//            $picture = new Picture();
//            $picture->setPath($oldSai['BLASON']);
//            $team->setPicture($picture);
//            $manager->persist($team);
//        }
//        $manager->flush();
//
//        //Stades
//        $sth = $pdo->prepare('SELECT * FROM `archive_lieu`');
//        $sth->execute();
//        $oldSais =  $sth->fetchAll();
//        foreach ($oldSais as $oldSai){
//            $newEntity = new Stadium();
//            $newEntity->setOldId($oldSai['ID_LIEU'])
//                ->setName($oldSai['LIBELLE_LIEU'])
//            ;
//            $manager->persist($newEntity);
//        }
//        $manager->flush();
//        
//        //joueurs
//        $sth = $pdo->prepare('SELECT * FROM `archive_joueur`');
//        $sth->execute();
//        $oldSais =  $sth->fetchAll();
//        foreach ($oldSais as $oldSai){
//            $newEntity = new Player();
//            $newEntity->setOldId($oldSai['ID_JOUEUR'])
//                ->setFirstName($oldSai['PRENOM'])
//                ->setLastName($oldSai['NOM'])
//                ->setActive($oldSai['ACTIF'])
//                ->setBirthDate(new \DateTime($oldSai['DATE_NAISSANCE']))
//                ->setContract($oldSai['CONTRAT'])
//                ->setDescription($oldSai['DESCRIPTION'])
//                ->setHeight($oldSai['TAILLE'])
//                ->setWeight($oldSai['POIDS'])
//                ->setNumber($oldSai['NUMERO'])
//                ->setPosition($oldSai['POSTE'])
//                ->setTeamName($oldSai['CLUB'])
//                ->setType($oldSai['TYPE'])
//            ;
//            if (isset ($oldSai['NATIONALITE']) && null !== $oldSai['NATIONALITE']){
//                $nationality = $natRepo->findOneBy(['oldId'=>$oldSai['NATIONALITE']]);
//                $newEntity->setNationality($nationality);    
//            }
//            if (isset ($oldSai['PHOTO']) && null !== $oldSai['PHOTO']){
//                $picture = new Picture();
//                $picture->setPath($oldSai['PHOTO']);
//                $newEntity->setPicture($picture);
//            }
//            
//            
//            $sth2 = $pdo->prepare('SELECT * FROM `archive_joueur_saison` WHERE `ID_JOUEUR`="'.$oldSai['ID_JOUEUR'].'"');
//            $sth2->execute();
//            $oldSais2 =  $sth2->fetchAll();
//            foreach ($oldSais2 as $olsSai2){
////                dump($olsSai2);
//                $season = $manager->getRepository('AppBundle:Saison')->findOneByOldId($olsSai2['ID_SAISON']);
//                if (null !== $season){
//                    $newEntity->addSeason($season);
//                }
//            }
//
//            $manager->persist($newEntity);
//            
//            
//        }
//        $manager->flush();
//        
//        //Matchs
//        $teamRepo = $manager->getRepository('AppBundle:Team');
//        $competRepo = $manager->getRepository('AppBundle:Competition');
//        $saisonRepo = $manager->getRepository('AppBundle:Saison');
//        $coachRepo = $manager->getRepository('AppBundle:Coach');
//        $arbRepo = $manager->getRepository('AppBundle:Arbitre');
//        
//        
//        $sth = $pdo->prepare('SELECT * FROM `archive_match`');
//        $sth->execute();
//        $oldSais =  $sth->fetchAll();
//        foreach ($oldSais as $oldSai){
//            $awayTeam = $teamRepo->findOneBy(['oldId'=>$oldSai['EQUIPE_AWAY']]);
//            $homeTeam = $teamRepo->findOneBy(['oldId'=>$oldSai['EQUIPE_HOME']]);
//            $competition = $competRepo->findOneBy(['oldId'=>$oldSai['COMPETITION']]);
//            $saison = $saisonRepo->findOneBy(['oldId'=>$oldSai['ID_SAISON']]);
//            $arbitre = $arbRepo->findOneBy(['oldId'=>$oldSai['ARBITRE']]);
//            $coach = $coachRepo->findOneBy(['oldId'=>$oldSai['ENTRAINEUR']]);
//            
//            $newEntity = new MatchGame();
//            $newEntity->setOldId($oldSai['ID_MATCH'])
//                ->setDescription($oldSai['TEXTE'])
//                ->setName($oldSai['LIBELLE_MATCH'])
//                ->setAwayTeam($awayTeam)
//                ->setHomeTeam($homeTeam)
//                ->setArbitre($arbitre)
//                ->setCoach($coach)
//                ->setCompetition($competition)
//                ->setDate(new \DateTime($oldSai['DATE_MATCH']))
//                ->setSaison($saison)
//                ->setScoreAwayFinal($oldSai['SCORE_AWAY_FINAL'])
//                ->setScoreHomeFinal($oldSai['SCORE_HOME_FINAL'])
//                ->setScoreAwayProlong($oldSai['SCORE_AWAY_PROL'])
//                ->setScoreHomeProlong($oldSai['SCORE_HOME_PROL'])
//                ->setScoreHomePen($oldSai['SCORE_HOME_PENO'])
//                ->setScoreAwayPen($oldSai['SCORE_AWAY_PENO'])
//                ->setVenue($oldSai['ASSISTANCE'])
//                
//            ;
//            $manager->persist($newEntity);
//        }
//        $manager->flush();
//        
//        //MAtchEvent
//        $sth = $pdo->prepare('SELECT * FROM `archive_event`');
//        $sth->execute();
//        $oldSais =  $sth->fetchAll();
        $matchRepo = $manager->getRepository('AppBundle:MatchGame');
        $playerRepo = $manager->getRepository('AppBundle:Player');
//        foreach ($oldSais as $oldSai){
//            $match = $matchRepo->findOneBy(['oldId'=>$oldSai['ID_MATCH']]);
//            $player = $playerRepo->findOneBy(['oldId'=>$oldSai['ID_JOUEUR']]);
//            $newEntity = new MatchEvent();
//            $newEntity->setOldId($oldSai['ID_EVENT'])
//                ->setType($oldSai['TYPE'])
//                ->setMinute($oldSai['MINUTE'])
//                ->setPlayer($player)
//                ->setMatch($match)
//            ;
//            $manager->persist($newEntity);
//        }
//        $manager->flush();
//        
//        
        //PlayerVote
        $sth = $pdo->prepare('SELECT * FROM `archive_match_joueur`');
        $sth->execute();
        $oldSais =  $sth->fetchAll();
        foreach ($oldSais as $oldSai){
            $player = $playerRepo->findOneBy(['oldId'=>$oldSai['ID_JOUEUR']]);
            $match = $matchRepo->findOneBy(['oldId'=>$oldSai['ID_MATCH']]);
            $playerVote = new PlayerVote();
            $playerVote->setPlayer($player)
                ->setOldId($oldSai['ID_MATCH_JOUEUR'])
                ->setCote($oldSai['TOTAL_COTE'])
                ->setNbrVotes($oldSai['NB_VOTE'])
                ->setMinutesPlayed($oldSai['TOTAL_MINUTE'])
                ->setMatch($match)
                ;
            $manager->persist($playerVote);
            
            
        }
        
        $manager->flush();
        
//        //Classement SAison
//        $sth = $pdo->prepare('SELECT * FROM `archive_classement_saison`');
//        $sth->execute();
//        $oldSais =  $sth->fetchAll();
//        foreach ($oldSais as $oldSai){
//            $saison = $saisonRepo->findOneBy(['oldId'=>$oldSai['ID_SAISON']]);
//            $newEntity = new ClassementSaison();
//            $newEntity->setOldId($oldSai['ID'])
//                    ->setDraw($oldSai['NUL'])
//                    ->setWon($oldSai['GAGNE'])
//                    ->setLost($oldSai['DEFAITE'])
//                ->setGoalsAgainst($oldSai['GOAL_CONTRE'])
//                ->setGoalsScored($oldSai['GOAL_POUR'])
//                ->setPoints($oldSai['POINT'])
//                ->setPlayed($oldSai['JOUE'])
//                ->setTeamName($oldSai['LIBELLE_EQUIPE'])
//                ->setSaison($saison)
//                ;
//            $manager->persist($newEntity);
//        }
//        $manager->flush();
//        




    }
}
<?php

/**
* Fichier appelant les requètes de statistiques
*
* @author Aristide Pichereau & Raphael Souquiere
* @version 1.0.0
*
*/

namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BackBundle\Entity\User;
use BackBundle\Entity\Cle;
use BackBundle\Entity\TypeUser;
use \Datetime;

class StatistiqueController extends Controller


{

  /**
  * Envoie toute les statistique nécessaire a la page de statistique
  *
  *
  * @return retourne la vue affichant les statistique ainsi qu'un tableau avec lme résultat de toute les requète sur la base de donnée
  */


  public function statAction()
  {

    $em = $this->getDoctrine()->getManager();

    //Statistique d'activité des utilisateurs

    $nbuseractif = $em->getRepository(User::class)->findUserActif();
    $nbuserinactif = $em->getRepository(User::class)->findUserInactif();
    $nbuser = $em->getRepository(User::class)->findUserTotal();

    //statistique d'état des clés

    $nbcleactif = $em->getRepository(Cle::class)->findCleActif();
    $nbcleinactif = $em->getRepository(Cle::class)->findCleInactif();
    $nbcle = $em->getRepository(Cle::class)->findCleTotal();

    //statistique du nombre de clé par site et par type

    $nbclebysites = $em->getRepository(Cle::class)->findCleBySite();
    $nbclebytypes = $em->getRepository(Cle::class)->findCleByType();

    //Evolution mensuel du nombre d'utilisateur et de clé crée

    $clemensuels = $em->getRepository(Cle::class)->evolutionmensuelcle();
    $usermensuels = $em->getRepository(User::class)->evolutionmensueluser();


    return $this->render('stat.html.twig', array(
      'nbuseractif' => $nbuseractif,
      'nbuserinactif' => $nbuserinactif,
      'nbuser' => $nbuser,
      'nbcleactif' => $nbcleactif,
      'nbcleinactif' => $nbcleinactif,
      'nbcle' => $nbcle,
      'nbclebytypes' => $nbclebytypes,
      'nbclebysites' => $nbclebysites,
      'clemensuels' => $clemensuels,
      'usermensuels' => $usermensuels,
    ));
  }

}

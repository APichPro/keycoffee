<?php

/**
* Controller de l'API
*
* @author Aristide Pichereau & Raphael Souquiere
* @version 1.0.0
*
*/

namespace ApiRestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BackBundle\Entity\User;
use BackBundle\Entity\Cle;
use BackBundle\Entity\Affecte;
use BackBundle\Entity\Site;


class DefaultController extends Controller
{
  public function indexAction()
  {
    return $this->render('ApiRestBundle:Default:index.html.twig');
  }

  /**
  *Envoie au format Json La liste des clés
  *
  *@return reponse au format JSON
  */


  public function listecleAction()
  {
    $cles = $this->getDoctrine()
    ->getRepository(Cle::class)
    ->findAllCle();
    $response = new Response();
    $response->setContent(json_encode($cles));
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');
    return $response;

  }

  /**
  *Envoie au format Json le detail d'une clé
  *
  *@param $id id de la clé
  *
  *@return reponse au format JSON
  */

  public function detailcleAction($id)
  {
    $cle = $this->getDoctrine()
    ->getRepository(Cle::class)
    ->findOne($id);

    $response = new Response();
    $response->setContent(json_encode($cle));;
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');
    return $response;
  }

  /**
  *Envoie au format Json La liste des utilisateurs associer a une clé
  *
  *@param $id id de la clé
  *
  *@return reponse au format JSON
  */

  public function detailcleusersAction($id)
  {

    $users = $this->getDoctrine()
    ->getRepository(User::class)
    ->findUserByCle($id);


    $response = new Response();
    $response->setContent(json_encode($users));
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');
    return $response;
  }

  /**
  *Envoie au format Json La liste des utilisateurs
  *
  *@return reponse au format JSON
  */

  public function listeuserAction()
  {
    $users = $this->getDoctrine()
    ->getRepository(User::class)
    ->findAllOrderedByName();
    $response = new Response();
    $response->setContent(json_encode($users));
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');
    return $response;
  }

  /**
  *Envoie au format Json le detail d'un utilisateurs
  *
  *@param $id id de l' utilisateur
  *
  *@return reponse au format JSON
  */

  public function detailuserAction($id)
  {
    $user = $this->getDoctrine()
    ->getRepository(User::class)
    ->findOne($id);


    $response = new Response();
    $response->setContent(json_encode($user));
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');
    return $response;
  }

  /**
  *Envoie au format Json La liste des clés associer a une utilisateurs
  *
  *@param $id id de l' utilisateur
  *
  *@return reponse au format JSON
  */

  public function detailuserclesAction($id)
  {

    $cles = $this->getDoctrine()
    ->getRepository(Cle::class)
    ->findCleByUser($id);

    $response = new Response();
    $response->setContent(json_encode($cles));
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');
    return $response;
  }

  /**
  *Envoie au format Json les resultat du formulaire
  *
  *@param $request contient les champ passer dans l'URL
  *
  *@return reponse au format JSON
  */

  public function searchuserAction(Request $request)
  {
    $nom = $request->query->get('nom');
    $site = $request->query->get('site');
    $typeUser = $request->query->get('typeUser');

    $search = $this->getDoctrine()
    ->getRepository(User::class)
    ->findSearchOrderedByName($nom,$site,$typeUser);

    $response = new Response();
    $response->setContent(json_encode($search));
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');
    return $response;
  }
}

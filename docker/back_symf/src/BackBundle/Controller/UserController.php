<?php

/**
* Fichier utiliser pour la gestion CRUD de la table User
*
*
* @author Aristide Pichereau & Raphael Souquiere
* @version 1.0.0
*
*/

namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use BackBundle\Entity\User;
use BackBundle\Form\UserrechercheType;
use \Datetime;

class UserController extends Controller


{


  /**
  * Affiche la liste des entités User
  *
  * @return
  */



  public function showallAction()
  {
    $em = $this->getDoctrine()->getManager();
    $users = $em->getRepository(User::class)->findAllOrderedByName();

    return $this->render('user/index.html.twig', array(
      'users' => $users,
    ));
  }

  /**
  * Affiche une entités User
  *
  *  @param $id est l'id de l'entité a afficher
  *
  * @return retourne la vue affichant le detail d'une User
  */

  public function showAction($id)
  {
    $em = $this->getDoctrine()->getManager();

    $user = $em->getRepository(User::class)->findOneBack($id);
    return $this->render('user/show.html.twig', array(
      'user' => $user,
    ));
  }

  /**
  * Créer une entités User
  *
  * @return retourne la vue affichant le formulaire de création d'une User
  */

  public function newAction(Request $request, User $user = null)
  {
    $user = new User();
    $form = $this->createForm('BackBundle\Form\UserType', $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $datetime = new DateTime();
      $user->setCreated($datetime);
      $user->setUpdated($datetime);
      $em = $this->getDoctrine()->getManager();
      $em->persist($user);

        //Gestion des erreur de creation

      try{

        $em->flush();
      }catch (\Doctrine\DBAL\DBALException $e){
        return $this->render('error.html.twig', [
          "title" => "Une erreur est survenue lors de la creation de l'entité",
          "message" => $e->getMessage(),
            "errorcode" => $e->getErrorCode()
        ]);
      }


      return $this->redirectToRoute('user_show', array('id' => $user->getId()));
    }

    return $this->render('user/new.html.twig', array('form' => $form->createView(),));
  }

  /**
  * Permet l'édition une entités User
  *
  *  @param $affecte est l'entité a éditer
  *
  * @return retourne la vue affichant la page d'édition d'une User
  */

  public function editAction(Request $request, User $user)

  {
    $deleteForm = $this->createFormBuilder()->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))->setMethod('DELETE')->getForm();

    $editForm = $this->createForm('BackBundle\Form\UserType', $user)->handleRequest($request);

    if ($editForm->isSubmitted() && $editForm->isValid()) {
      $datetime = new DateTime();
      $user->setUpdated($datetime);

        //Gestion des erreur d'édition

      try{


        $this->getDoctrine()->getManager()->flush();
      }catch (\Doctrine\DBAL\DBALException $e){
        return $this->render('error.html.twig', [
          "title" => "Une erreur est survenue lors de la modification de l'entité",
          "message" => $e->getMessage(),
          "errorcode" => $e->getErrorCode()
        ]);
      }



      return $this->redirectToRoute('user_show', array('id' => $user->getId()));
    }

    return $this->render('user/edit.html.twig', array(
      'user' => $user,
      'edit_form' => $editForm->createView(),
      'delete_form' => $deleteForm->createView(),
    ));
  }


  /**
  * Permet la suppression une entités User
  *
  *  @param $affecte est l'entité a supprimer
  *
  * @return supprime l'entité et retourne la vue affichant tout les Utilisateurs
  */


  public function deleteAction(Request $request, User $user)
  {
    $form = $this->createFormBuilder()
    ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))->setMethod('DELETE')->getForm()->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      $em = $this->getDoctrine()->getManager();
      $em->remove($user);

        //Gestion des erreur de suppression

      try{

        $em->flush();
      }catch (\Doctrine\DBAL\DBALException $e){
        return $this->render('error.html.twig', [
          "title" => "Une erreur est survenue lors de la suppression de l'entité",
          "message" => $e->getMessage(),
          "errorcode" => $e->getErrorCode()
        ]);
      }
    }

    return $this->redirectToRoute('user_index');
  }

}

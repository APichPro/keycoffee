<?php

/**
* Fichier utiliser pour la gestion CRUD de la table Etat
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
use BackBundle\Entity\Etat;

class EtatController extends Controller
{

  /**
  * Affiche la liste des entités Etat
  *
  * @return
  */


  public function showallAction()
  {
    $em = $this->getDoctrine()->getManager();

    $etats = $em->getRepository(Etat::class)->findAllOrderedByName();
    return $this->render('etat/index.html.twig', array(
      'etats' => $etats,
    ));
  }


  /**
  * Affiche une entités  Etat
  *
  *  @param $id est l'id de l'entité a afficher
  *
  * @return retourne la vue affichant le detail d'une Etat
  */


  public function showAction($id)
  {
    $em = $this->getDoctrine()->getManager();

    $etat = $em->getRepository(Etat::class)->findOne($id);
    return $this->render('etat/show.html.twig', array(
      'etat' => $etat,
    ));
  }

  /**
  * Créer une entités etat
  *
  *
  * @return retourne la vue affichant le formulaire de création d'une etat
  */

  public function newAction(Request $request, Etat $etat = null)
  {
    $etat = new Etat();
    $form = $this->createForm('BackBundle\Form\EtatType', $etat);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($etat);
      try{


        //Gestion des erreurs de creation


        $em->flush();
      }catch (\Doctrine\DBAL\DBALException $e){
        return $this->render('error.html.twig', [
          "title" => "Une erreur est survenue lors de la suppression de l'entité",
          "message" => $e->getMessage(),
          "errorcode" => $e->getErrorCode()
        ]);
      }


      return $this->redirectToRoute('etat_show', array('id' => $etat->getId()));
    }

    return $this->render('etat/new.html.twig', array('form' => $form->createView(),));
  }


  /**
  * Permet l'édition une entités Etat
  *
  *  @param $affecte est l'entité a éditer
  *
  * @return retourne la vue affichant la page d'édition d'une Etat
  */


  public function editAction(Request $request, Etat $etat)

  {
    $deleteForm = $this->createFormBuilder()->setAction($this->generateUrl('etat_delete', array('id' => $etat->getId())))->setMethod('DELETE')->getForm();

    $editForm = $this->createForm('BackBundle\Form\EtatType', $etat)->handleRequest($request);

    if ($editForm->isSubmitted() && $editForm->isValid()) {

      try{


        //Gestion des erreurs de modification


        $this->getDoctrine()->getManager()->flush();
      }catch (\Doctrine\DBAL\DBALException $e){
        return $this->render('error.html.twig', [
          "title" => "Une erreur est survenue lors de la suppression de l'entité",
          "message" => $e->getMessage(),
          "errorcode" => $e->getErrorCode()
        ]);
      }


      return $this->redirectToRoute('etat_show', array('id' => $etat->getId()));
    }

    return $this->render('etat/edit.html.twig', array(
      'etat' => $etat,
      'edit_form' => $editForm->createView(),
      'delete_form' => $deleteForm->createView(),
    ));
  }


  /**
  * Permet la suppression une entités Etat
  *
  *  @param $affecte est l'entité a supprimer
  *
  * @return supprime l'entité et retourne la vue affichant toute les etats
  */


  public function deleteAction(Request $request, Etat $etat)
  {
    $form = $this->createFormBuilder()
    ->setAction($this->generateUrl('etat_delete', array('id' => $etat->getId())))->setMethod('DELETE')->getForm()->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      $em = $this->getDoctrine()->getManager();
      $em->remove($etat);
      try{


        //Gestion des erreurs de suppression


        $em->flush();
      }catch (\Doctrine\DBAL\DBALException $e){
        return $this->render('error.html.twig', [
          "title" => "Une erreur est survenue lors de la suppression de l'entité",
          "message" => $e->getMessage(),
          "errorcode" => $e->getErrorCode()
        ]);
      }
    }

    return $this->redirectToRoute('etat_index');
  }

}

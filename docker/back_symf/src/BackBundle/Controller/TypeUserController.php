<?php

/**
* Fichier utiliser pour la gestion CRUD de la table TypeUser
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
use BackBundle\Entity\TypeUser;

class TypeUserController extends Controller
{

  /**
  * Affiche la liste des entités Site
  *
  * @return
  */

  public function showallAction()
  {
    $em = $this->getDoctrine()->getManager();
    $typeusers = $em->getRepository(TypeUser::class)->findAllOrderedByName();
    return $this->render('typeuser/index.html.twig', array(
      'typeusers' => $typeusers,
    ));
  }

  /**
  * Affiche une entités  TypeUser
  *
  *  @param $id est l'id de l'entité a afficher
  *
  * @return retourne la vue affichant le detail d'une TypeUser
  */

  public function showAction($id)
  {
    $em = $this->getDoctrine()->getManager();

    $typeuser = $em->getRepository(TypeUser::class)->findOne($id);
    return $this->render('typeuser/show.html.twig', array(
      'typeuser' => $typeuser,
    ));
  }

  /**
  * Créer une entités TypeUser
  *
  *
  * @return retourne la vue affichant le formulaire de création d'une TypeUser
  */

  public function newAction(Request $request, TypeUser $typeuser = null)
  {
    $typeuser = new TypeUser();
    $form = $this->createForm('BackBundle\Form\TypeUserType', $typeuser);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($typeuser);

      //Gestion des erreur de Création

      try{
        $em->flush();
      }catch (\Doctrine\DBAL\DBALException $e){
        return $this->render('error.html.twig', [
          "title" => "Une erreur est survenue lors de la suppression de l'entité",
          "message" => $e->getMessage(),
          "errorcode" => $e->getErrorCode()
        ]);
      }
      return $this->redirectToRoute('typeuser_show', array('id' => $typeuser->getId()));
    }

    return $this->render('typeuser/new.html.twig', array('form' => $form->createView(),));
  }

  /**
  * Permet l'édition une entités TypeUser
  *
  *  @param $affecte est l'entité a éditer
  *
  * @return retourne la vue affichant la page d'édition d'un TypeUser
  */

  public function editAction(Request $request, TypeUser $typeuser)

  {
    $deleteForm = $this->createFormBuilder()->setAction($this->generateUrl('typeuser_delete', array('id' => $typeuser->getId())))->setMethod('DELETE')->getForm();

    $editForm = $this->createForm('BackBundle\Form\TypeUserType', $typeuser)->handleRequest($request);

    if ($editForm->isSubmitted() && $editForm->isValid()) {
      $em = $this->getDoctrine()->getManager();

        //Gestion des erreur d'édition

      try{
        $em->flush();
      }catch (\Doctrine\DBAL\DBALException $e){
        return $this->render('error.html.twig', [
          "title" => "Une erreur est survenue lors de la suppression de l'entité",
          "message" => $e->getMessage(),
          "errorcode" => $e->getErrorCode()
        ]);
      }
      return $this->redirectToRoute('typeuser_show', array('id' => $typeuser->getId()));
    }

    return $this->render('typeuser/edit.html.twig', array(
      'typeuser' => $typeuser,
      'edit_form' => $editForm->createView(),
      'delete_form' => $deleteForm->createView(),
    ));
  }

  /**
  * Permet la suppression une entités TypeUser
  *
  *  @param $affecte est l'entité a supprimer
  *
  * @return supprime l'entité et retourne la vue affichant toute les TypeUsers
  */


  public function deleteAction(Request $request, TypeUser $typeuser)
  {
    $form = $this->createFormBuilder()
    ->setAction($this->generateUrl('typeuser_delete', array('id' => $typeuser->getId())))->setMethod('DELETE')->getForm()->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      $em = $this->getDoctrine()->getManager();
      $em->remove($typeuser);

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

    return $this->redirectToRoute('typeuser_index');
  }
}

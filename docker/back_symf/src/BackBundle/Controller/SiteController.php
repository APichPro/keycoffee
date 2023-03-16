<?php

/**
* Fichier utiliser pour la gestion CRUD de la table Site
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
use BackBundle\Entity\Site;

class SiteController extends Controller
{

  /**
  * Affiche la liste des entités Site
  *
  * @return
  */

  public function showallAction()
  {
    $em = $this->getDoctrine()->getManager();

    $sites = $em->getRepository(Site::class)->findAllOrderedByName();
    return $this->render('site/index.html.twig', array(
      'sites' => $sites,
    ));
  }

  /**
  * Affiche une entités  Site
  *
  *  @param $id est l'id de l'entité a afficher
  *
  * @return retourne la vue affichant le detail d'une Site
  */

  public function showAction($id)
  {
    $em = $this->getDoctrine()->getManager();

    $site = $em->getRepository(Site::class)->findOne($id);
    return $this->render('site/show.html.twig', array(
      'site' => $site,
    ));
  }

  /**
  * Créer une entités Site
  *
  *
  * @return retourne la vue affichant le formulaire de création d'une Site
  */


  public function newAction(Request $request, Site $site = null)
  {
    $site = new Site();
    $form = $this->createForm('BackBundle\Form\SiteType', $site);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($site);

      //Gestion des erreur de création

      try{

        $em->flush();
      }catch (\Doctrine\DBAL\DBALException $e){
        return $this->render('error.html.twig', [
          "title" => "Une erreur est survenue lors de la creation de l'entité",
          "message" => $e->getMessage(),
          "errorcode" => $e->getErrorCode()
        ]);
      }

      return $this->redirectToRoute('site_show', array('id' => $site->getId()));
    }

    return $this->render('site/new.html.twig', array('form' => $form->createView(),));
  }


  /**
  * Permet l'édition une entités Site
  *
  *  @param $affecte est l'entité a éditer
  *
  * @return retourne la vue affichant la page d'édition d'une Site
  */


  public function editAction(Request $request, Site $site)

  {
    $deleteForm = $this->createFormBuilder()->setAction($this->generateUrl('site_delete', array('id' => $site->getId())))->setMethod('DELETE')->getForm();

    $editForm = $this->createForm('BackBundle\Form\SiteType', $site)->handleRequest($request);

    if ($editForm->isSubmitted() && $editForm->isValid()) {

      //Gestion des erreur d'édition

      try{

        $this->getDoctrine()->getManager()->flush();

      }catch (\Doctrine\DBAL\DBALException $e){
        return $this->render('error.html.twig', [
          "title" => "Une erreur est survenue lors de l'edition de l'entité",
          "message" => $e->getMessage(),
          "errorcode" => $e->getErrorCode()
        ]);
      }


      return $this->redirectToRoute('site_show', array('id' => $site->getId()));
    }

    return $this->render('site/edit.html.twig', array(
      'site' => $site,
      'edit_form' => $editForm->createView(),
      'delete_form' => $deleteForm->createView(),
    ));
  }

  /**
  * Permet la suppression une entités Site
  *
  *  @param $affecte est l'entité a supprimer
  *
  * @return supprime l'entité et retourne la vue affichant toute les Sites
  */

  public function deleteAction(Request $request, Site $site)
  {
    $form = $this->createFormBuilder()
    ->setAction($this->generateUrl('site_delete', array('id' => $site->getId())))->setMethod('DELETE')->getForm()->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      $em = $this->getDoctrine()->getManager();
      $em->remove($site);

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

    return $this->redirectToRoute('site_index');
  }
}

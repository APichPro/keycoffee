<?php

/**
* Repository de l'entité site
*
* @author Aristide Pichereau & Raphael Souquiere
* @version 1.0.0
*
*/

namespace BackBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SiteRepository extends EntityRepository
{

  /**
  *Récupère tous les sites
  *
  */

  public function findAllOrderedByName()
  {
    return $this->getEntityManager()
    ->createQuery(
      'SELECT p FROM BackBundle:Site p ORDER BY p.id ASC'
      )
      ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
    }

    /**
    *récupère un site
    *
    *@param $id id du site
    */

    public function findOne($id)
    {
      return $this->getEntityManager()
      ->createQuery(
        'SELECT p FROM BackBundle:Site p WHERE p.id = :id'
        )->setParameter("id", $id)
        ->getOneOrNullResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
      }
    }

<?php

/**
* Repository de l'entité typeuser
*
* @author Aristide Pichereau & Raphael Souquiere
* @version 1.0.0
*
*/

namespace BackBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TypeUserRepository extends EntityRepository
{

  /**
  *Récupère tous les typeusers
  *
  */

  public function findAllOrderedByName()
  {
    return $this->getEntityManager()
    ->createQuery(
      'SELECT p FROM BackBundle:TypeUser p ORDER BY p.id ASC'
      )
      ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
    }

    /**
    *récupère un typeuser
    *
    *@param $id id du typeuser
    */

    public function findOne($id)
    {
      return $this->getEntityManager()
      ->createQuery(
        'SELECT p FROM BackBundle:TypeUser p WHERE p.id = :id'
        )->setParameter("id", $id)
        ->getOneOrNullResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
      }
    }

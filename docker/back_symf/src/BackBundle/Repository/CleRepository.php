<?php

/**
* Repository de l'entité Clé
*
* @author Aristide Pichereau & Raphael Souquiere
* @version 1.0.0
*
*/

namespace BackBundle\Repository;

use Doctrine\ORM\EntityRepository;
use DoctrineExtensions\Query\Mysql\Month;
use DoctrineExtensions\Query\Mysql\Year;
use DoctrineExtensions\Query\Mysql\IfNull;

class CleRepository extends EntityRepository
{

  /**
  *récupère toute les clé
  *
  */

  public function findAllCle()
  {
    return $this->getEntityManager()
    ->createQuery(
      "SELECT p.numCle,p.montantInitial,p.id,
      CASE WHEN IDENTITY(p.idEtat) IS NULL THEN 'Active' ELSE e.causeArret END AS etat
      FROM BackBundle:Cle p
      LEFT JOIN BackBundle:Etat e
      WITH p.idEtat = e.id OR e.id IS NULL
      ORDER BY p.numCle"
      )
      ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
    }

    /**
    *récupère une clé
    *
    *@param $id id de la clé
    */


    public function findOne($id)
    {
      return $this->getEntityManager()
      ->createQuery(
        "SELECT p.numCle,p.dateCreation,p.dateArret,p.commentaire,p.created,p.updated,p.montantInitial,p.id,
        CASE WHEN IDENTITY(p.idEtat) IS NULL THEN 'Active' ELSE e.causeArret END AS etat
        FROM BackBundle:Cle p
        LEFT JOIN BackBundle:Etat e
        WITH p.idEtat = e.id OR e.id IS NULL WHERE p.id = :id "
        )->setParameter("id", $id)
        ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
      }

      /**
      *Récupère une clé backoffice
      *
      *@param $id id de la clé
      */

      public function findOneBack($id)
      {
        return $this->getEntityManager()
        ->createQuery(
          "SELECT p.numCle,p.dateCreation,p.dateArret,p.commentaire,p.created,p.updated,p.montantInitial,p.id,
          CASE WHEN IDENTITY(p.idEtat) IS NULL THEN 'Active' ELSE e.causeArret END AS etat
          FROM BackBundle:Cle p
          LEFT JOIN BackBundle:Etat e
          WITH p.idEtat = e.id OR e.id IS NULL WHERE p.id = :id "
          )->setParameter("id", $id)
          ->getOneOrNullResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        }

        /**
        *Récupère toute les clé associer a un utilisateur
        *
        *@param $id id de l'utilisateur
        */

        public function findCleByUser($id)
        {
          return $this->getEntityManager()
          ->createQuery("SELECT c.id,c.numCle,c.montantInitial,c.commentaire,c.dateArret,c.dateCreation,a.dateAffectation,a.dateSuppression,CASE WHEN IDENTITY(c .idEtat) IS NULL THEN 'Active' ELSE e.causeArret END AS etat
          FROM BackBundle:Cle c
          INNER JOIN BackBundle:Affecte a WHERE a.idCle = c.id
          LEFT JOIN BackBundle:Etat e
          WITH c.idEtat = e.id OR e.id IS NULL
          INNER JOIN BackBundle:User p WHERE a.idUser = p.id  AND p.id = :id
          INNER JOIN BackBundle:TypeUser t WHERE p.idTypeUser = t.id
          INNER JOIN BackBundle:Site s WHERE p.idSite = s.id
          ORDER BY a.dateAffectation")
          ->setParameter("id", $id)
          ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        }


        //Requete pour la page de statistique

        /**
        *Récupère le nombre de clé active
        *
        */

        public function findCleActif()
        {
          return $this->getEntityManager()
          ->createQuery(
            'SELECT COUNT(p) FROM BackBundle:Cle p
            WHERE p.idEtat IS NULL')
            ->getSingleScalarResult();
          }

          /**
          *Récupère le nombre de clé inactive
          *
          */

          public function findCleInactif()
          {
            return $this->getEntityManager()
            ->createQuery(
              'SELECT COUNT(p) FROM BackBundle:Cle p
              INNER JOIN BackBundle:Etat e
              WHERE p.idEtat = e.id AND e.causeArret IS NOT NULL')
              ->getSingleScalarResult();
            }

            /**
            *Récupère le nombre total de clé
            *
            */

            public function findCleTotal()
            {
              return $this->getEntityManager()
              ->createQuery(
                'SELECT COUNT(p) FROM BackBundle:Cle p'
                )->getSingleScalarResult();
              }

              /**
              *Recupère le nombre de clé par type d'utilisateur
              *
              */

              public function findCleByType()
              {
                return $this->getEntityManager()
                ->createQuery(
                  'SELECT t.typeUser ,COUNT(c.id) AS nb
                  FROM BackBundle:Cle c
                  INNER JOIN BackBundle:Affecte a WHERE a.idCle = c.id
                  INNER JOIN BackBundle:User p WHERE a.idUser = p.id
                  INNER JOIN BackBundle:TypeUser t WHERE p.idTypeUser = t.id
                  GROUP BY t.typeUser')
                  ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
                }

                /**
                *Recupère le nombre de clé par site
                *
                */

                public function findCleBySite()
                {
                  return $this->getEntityManager()
                  ->createQuery(
                    'SELECT IFNULL(COUNT(c), 0) AS nb ,s.site FROM BackBundle:Cle c
                    INNER JOIN BackBundle:Affecte a WHERE a.idCle = c.id
                    INNER JOIN BackBundle:User p WHERE a.idUser = p.id
                    INNER JOIN BackBundle:Site s WHERE p.idSite = s.id
                    GROUP BY s.site ')
                    ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
                  }

                  /**
                  *Récupère le nombre de clé par mois
                  *
                  */

                  public function evolutionmensuelcle()
                  {
                    return $this->getEntityManager()
                    ->createQuery(
                      'SELECT MONTH(c.created) as da,
                      YEAR(c.created) as ye,
                      COUNT(c) as nb
                      FROM BackBundle:Cle c
                      GROUP BY da,ye
                      ORDER BY YEAR(c.created),MONTH(c.created) ASC')
                      ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
                    }
                  }

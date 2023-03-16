<?php

/**
* Repository de l'entité user
*
* @author Aristide Pichereau & Raphael Souquiere
* @version 1.0.0
*
*/

namespace BackBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
  public function findAllOrderedByName()
  {

    //Récupère tous les utilisateurs

    return $this->getEntityManager()
    ->createQuery(
      'SELECT p.id,p.nom,p.prenom,p.actif,t.typeUser,s.site FROM BackBundle:User p
      INNER JOIN BackBundle:TypeUser t WHERE p.idTypeUser = t.id
      INNER JOIN BackBundle:Site s
      WHERE p.idSite = s.id ORDER BY p.nom'
      )
      ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
    }

    /**
    *Récupère tous les utilisateurs possédant une clé
    *
    */

    public function findAllOrderedByNameFront()
    {
      return $this->getEntityManager()
      ->createQuery(
        'SELECT p.id,p.nom,p.prenom,p.actif,t.typeUser,s.site FROM BackBundle:User p
        INNER JOIN BackBundle:TypeUser t WITH p.idTypeUser = t.id
        INNER JOIN BackBundle:Site s WITH p.idSite = s.id
        INNER JOIN BackBundle:Affecte a WHERE a.idUser = p.id
        INNER JOIN BackBundle:Cle c WHERE a.idCle = c.id
        WHERE a.idUser = p.id ORDER BY p.nom'
        )
        ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
      }

      /**
      *récupère l'utilisateur d'id
      *
      *@param $id id de l'utilisateur
      *
      */

      public function findOne($id)
      {
        {
          return $this->getEntityManager()
          ->createQuery(
            'SELECT p.id,p.nom,p.prenom,p.actif,p.created,
            p.updated,t.typeUser,s.site
            FROM BackBundle:User p INNER JOIN BackBundle:TypeUser t WHERE p.idTypeUser = t.id
            INNER JOIN BackBundle:Site s
            WHERE p.idSite = s.id AND p.id = :id'
            )->setParameter("id", $id)
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
          }
        }

        /**
        *Récupère un utilisateur pour le back office
        *
        *@param $id id de l'utilisateur
        *
        */

        public function findOneBack($id)
        {
          {
            return $this->getEntityManager()
            ->createQuery(
              'SELECT p.id,p.nom,p.prenom,p.actif,p.created,
              p.updated,t.typeUser,s.site
              FROM BackBundle:User p
              INNER JOIN BackBundle:TypeUser t WHERE p.idTypeUser = t.id
              INNER JOIN BackBundle:Site s
              WHERE p.idSite = s.id AND p.id = :id'
              )->setParameter("id", $id)
              ->getOneOrNullResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            }
          }

          /**
          *Récupère les utilisateur associer a une clé
          *
          *@param $id id de la clé
          *
          */

          public function findUserByCle($id)
          {
            return $this->getEntityManager()
            ->createQuery('SELECT p.id,c.id,a.id,p.nom,p.prenom,p.actif,c.numCle,c.dateCreation,c.dateArret,a.dateAffectation , a.dateSuppression,s.site,t.typeUser,a.created,a.updated
              FROM BackBundle:User p
              INNER JOIN BackBundle:Affecte a WHERE a.idUser = p.id
              INNER JOIN BackBundle:Cle c WHERE a.idCle = c.id  AND c.id = :id
              INNER JOIN BackBundle:TypeUser t WHERE p.idTypeUser = t.id
              INNER JOIN BackBundle:Site s WHERE p.idSite = s.id ORDER BY a.dateAffectation')
              ->setParameter("id", $id)
              ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            }



            //stat

            /**
            *Récupère le nombre d' utilisateurs actif
            *
            *
            */

            public function findUserActif()
            {
              return $this->getEntityManager()
              ->createQuery(
                'SELECT COUNT(p) FROM BackBundle:User p WHERE p.actif = 1'
                )->getSingleScalarResult();
              }

              /**
              *Récupère le nombre d' utilisateurs inactif
              *
              */

              public function findUserInactif()
              {
                return $this->getEntityManager()
                ->createQuery(
                  'SELECT COUNT(p) FROM BackBundle:User p WHERE p.actif = 0'
                  )->getSingleScalarResult();
                }

                /**
                *Récupère le nombre utilisateurs total
                *
                */

                public function findUserTotal()
                {
                  return $this->getEntityManager()
                  ->createQuery(
                    'SELECT COUNT(p) FROM BackBundle:User p'
                    )->getSingleScalarResult();
                  }

                  /**
                  *Récupère le nombre d'utilisateur créer par mois
                  *
                  */

                  public function evolutionmensueluser()
                  {
                    return $this->getEntityManager()
                    ->createQuery(
                      'SELECT MONTH(c.created) as da,
                      YEAR(c.created) as ye,
                      COUNT(c) as nb
                      FROM BackBundle:User c
                      GROUP BY da,ye
                      ORDER BY YEAR(c.created),MONTH(c.created) ASC')
                      ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
                    }

                    /**
                    *Recherche un utilisateur grace a son nom , son site et son type
                    *
                    *@param $nom le nom de l'utilisateur , $site le site de l'utilisateur , $typeUSer son type
                    */

                    public function findSearchOrderedByName($nom,$site,$typeUser)
                    {
                      $em = $this->createQueryBuilder("u");

                      $em->select("u.id,u.nom,u.prenom,u.actif,typeUser.typeUser,site.site");
                      $em->innerJoin("u.idTypeUser", "typeUser");
                      $em->innerJoin("u.idSite", "site");

                      $em->where("true = true");

                      if($nom)
                      $em->andWhere("u.nom = :nom");
                      if($site)
                      $em->andWhere("site.site = :site");
                      if($typeUser)
                      $em->andWhere("typeUser.typeUser = :typeUser");


                      if($nom)
                      $em->setParameter("nom", $nom);
                      if($site )
                      $em->setParameter("site",$site);
                      if($typeUser )
                      $em->setParameter("typeUser", $typeUser);

                      return $em->getQuery()->getArrayResult();
                    }
                  }

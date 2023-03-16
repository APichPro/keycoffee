<?php

namespace BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cle
 *
 * @ORM\Table(name="cle", indexes={@ORM\Index(name="cle_etat_FK", columns={"id_etat"})})
 * @ORM\Entity(repositoryClass="BackBundle\Repository\CleRepository")
 */
class Cle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="num_cle", type="integer", nullable=false)
     */
    private $numCle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="date", nullable=false)
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_arret", type="date", nullable=false)
     */
    private $dateArret;

    /**
     * @var float
     *
     * @ORM\Column(name="montant_initial", type="float", precision=10, scale=0, nullable=false)
     */
    private $montantInitial;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=250, nullable=false)
     */
    private $commentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     */
    private $updated;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \BackBundle\Entity\Etat
     *
     * @ORM\ManyToOne(targetEntity="BackBundle\Entity\Etat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_etat", referencedColumnName="id")
     * })
     */
    private $idEtat;



    /**
     * Set numCle
     *
     * @param integer $numCle
     *
     * @return Cle
     */
    public function setNumCle($numCle)
    {
        $this->numCle = $numCle;

        return $this;
    }

    /**
     * Get numCle
     *
     * @return integer
     */
    public function getNumCle()
    {
        return $this->numCle;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Cle
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set dateArret
     *
     * @param \DateTime $dateArret
     *
     * @return Cle
     */
    public function setDateArret($dateArret)
    {
        $this->dateArret = $dateArret;

        return $this;
    }

    /**
     * Get dateArret
     *
     * @return \DateTime
     */
    public function getDateArret()
    {
        return $this->dateArret;
    }

    /**
     * Set montantInitial
     *
     * @param float $montantInitial
     *
     * @return Cle
     */
    public function setMontantInitial($montantInitial)
    {
        $this->montantInitial = $montantInitial;

        return $this;
    }

    /**
     * Get montantInitial
     *
     * @return float
     */
    public function getMontantInitial()
    {
        return $this->montantInitial;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Cle
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Cle
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Cle
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idEtat
     *
     * @param \BackBundle\Entity\Etat $idEtat
     *
     * @return Cle
     */
    public function setIdEtat(\BackBundle\Entity\Etat $idEtat = null)
    {
        $this->idEtat = $idEtat;

        return $this;
    }

    /**
     * Get idEtat
     *
     * @return \BackBundle\Entity\Etat
     */
    public function getIdEtat()
    {
        return $this->idEtat;
    }

    public function __toString()
    {
        return (string) $this->numCle;
    }
}

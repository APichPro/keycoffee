<?php

namespace BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Affecte
 *
 * @ORM\Table(name="affecte", indexes={@ORM\Index(name="affecte_cle_FK", columns={"id_cle"}), @ORM\Index(name="affecte_user0_FK", columns={"id_user"})})
 * @ORM\Entity(repositoryClass="BackBundle\Repository\AffecteRepository")
 */
class Affecte
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_affectation", type="date", nullable=false)
     */
    private $dateAffectation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_suppression", type="date", nullable=false)
     */
    private $dateSuppression;

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
     * @var \BackBundle\Entity\Cle
     *
     * @ORM\ManyToOne(targetEntity="BackBundle\Entity\Cle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cle", referencedColumnName="id")
     * })
     */
    private $idCle;

    /**
     * @var \BackBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="BackBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;



    /**
     * Set dateAffectation
     *
     * @param \DateTime $dateAffectation
     *
     * @return Affecte
     */
    public function setDateAffectation($dateAffectation)
    {
        $this->dateAffectation = $dateAffectation;

        return $this;
    }

    /**
     * Get dateAffectation
     *
     * @return \DateTime
     */
    public function getDateAffectation()
    {
        return $this->dateAffectation;
    }

    /**
     * Set dateSuppression
     *
     * @param \DateTime $dateSuppression
     *
     * @return Affecte
     */
    public function setDateSuppression($dateSuppression)
    {
        $this->dateSuppression = $dateSuppression;

        return $this;
    }

    /**
     * Get dateSuppression
     *
     * @return \DateTime
     */
    public function getDateSuppression()
    {
        return $this->dateSuppression;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Affecte
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
     * @return Affecte
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
     * Set idCle
     *
     * @param \BackBundle\Entity\Cle $idCle
     *
     * @return Affecte
     */
    public function setIdCle(\BackBundle\Entity\Cle $idCle = null)
    {
        $this->idCle = $idCle;

        return $this;
    }

    /**
     * Get idCle
     *
     * @return \BackBundle\Entity\Cle
     */
    public function getIdCle()
    {
        return $this->idCle;
    }

    /**
     * Set idUser
     *
     * @param \BackBundle\Entity\User $idUser
     *
     * @return Affecte
     */
    public function setIdUser(\BackBundle\Entity\User $idUser = null)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \BackBundle\Entity\User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
}

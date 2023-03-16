<?php

namespace BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", indexes={@ORM\Index(name="user_type_user_FK", columns={"id_type_user"}), @ORM\Index(name="user_site0_FK", columns={"id_site"})})
 * @ORM\Entity(repositoryClass="BackBundle\Repository\UserRepository")
 */
class User
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=false)
     */
    private $prenom;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actif", type="boolean", nullable=false)
     */
    private $actif;

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
     * @var \BackBundle\Entity\Site
     *
     * @ORM\ManyToOne(targetEntity="BackBundle\Entity\Site")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_site", referencedColumnName="id")
     * })
     */
    private $idSite;

    /**
     * @var \BackBundle\Entity\TypeUser
     *
     * @ORM\ManyToOne(targetEntity="BackBundle\Entity\TypeUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_user", referencedColumnName="id")
     * })
     */
    private $idTypeUser;



    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     *
     * @return User
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get actif
     *
     * @return boolean
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return User
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
     * @return User
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
     * Set idSite
     *
     * @param \BackBundle\Entity\Site $idSite
     *
     * @return User
     */
    public function setIdSite(\BackBundle\Entity\Site $idSite = null)
    {
        $this->idSite = $idSite;

        return $this;
    }

    /**
     * Get idSite
     *
     * @return \BackBundle\Entity\Site
     */
    public function getIdSite()
    {
        return $this->idSite;
    }

    /**
     * Set idTypeUser
     *
     * @param \BackBundle\Entity\TypeUser $idTypeUser
     *
     * @return User
     */
    public function setIdTypeUser(\BackBundle\Entity\TypeUser $idTypeUser = null)
    {
        $this->idTypeUser = $idTypeUser;

        return $this;
    }

    /**
     * Get idTypeUser
     *
     * @return \BackBundle\Entity\TypeUser
     */
    public function getIdTypeUser()
    {
        return $this->idTypeUser;
    }

    public function __toString()
    {

        return (string) $this->nom;
    }
}

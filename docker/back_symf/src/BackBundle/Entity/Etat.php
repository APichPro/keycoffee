<?php

namespace BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etat
 *
 * @ORM\Table(name="etat")
 * @ORM\Entity(repositoryClass="BackBundle\Repository\EtatRepository")
 */
class Etat
{
    /**
     * @var string
     *
     * @ORM\Column(name="cause_arret", type="string", length=50, nullable=false)
     */
    private $causeArret;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set causeArret
     *
     * @param string $causeArret
     *
     * @return Etat
     */
    public function setCauseArret($causeArret)
    {
        $this->causeArret = $causeArret;

        return $this;
    }

    /**
     * Get causeArret
     *
     * @return string
     */
    public function getCauseArret()
    {
        return $this->causeArret;
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

    public function __toString()
    {
        return (string) $this->causeArret;
    }
}

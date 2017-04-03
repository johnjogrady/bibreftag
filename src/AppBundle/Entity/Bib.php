<?php
/**
 * Created by PhpStorm.
 * User: john.ogrady
 * Date: 01/04/2017
 * Time: 21:11
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
/**
 * Bib
 *
 * @ORM\Table(name="Bib")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BibRepository")
 */
class Bib
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

   /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $bibName;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $ownerId;


    /**
     * @var boolean
     * @ORM\Column(name="is_private", type="boolean")
     */
    private $isPrivate;

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
     * Set name
     *
     * @param string $name
     *
     * @return Bib
     */
    public function setName($name)
    {
        $this->bibName= $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->bibName;
    }





    /**
     * Set isPrivate
     *
     * @param boolean $isPrivate
     *
     * @return Bib
     */
    public function setIsPrivate($isPrivate)
    {
        $this->isPrivate = $isPrivate;

        return $this;
    }

    /**
     * Get isPrivate
     *
     * @return boolean
     */
    public function getIsPrivate()
    {
        return $this->isPrivate;
    }

    /**
     * Set ownerId
     *
     * @param \AppBundle\Entity\User $ownerId
     *
     * @return Bib
     */
    public function setOwnerId(\AppBundle\Entity\User $ownerId = null)
    {
        $this->ownerId = $ownerId;

        return $this;
    }

    /**
     * Get ownerId
     *
     * @return \AppBundle\Entity\User
     */
    public function getOwnerId()
    {
        return $this->ownerId;
    }
    public function __toString()
    {
        return $this->bibName;
    }



    /**
     * Set bibName
     *
     * @param string $bibName
     *
     * @return Bib
     */
    public function setBibName($bibName)
    {
        $this->bibName = $bibName;

        return $this;
    }

    /**
     * Get bibName
     *
     * @return string
     */
    public function getBibName()
    {
        return $this->bibName;
    }
}

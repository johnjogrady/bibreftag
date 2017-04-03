<?php
/**
 * Created by PhpStorm.
 * User: john.ogrady
 * Date: 27/03/2017
 * Time: 22:31
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Ref
 *
 * @ORM\Table(name="Ref")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RefRepository")
 */

class Ref
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
     * @ORM\Column(type="string")
     */
    private $refName;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     */
    private $publicationYear;

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     */


    /**
     * @ORM\ManyToOne(targetEntity="Publication")
     * @ORM\JoinColumn(name="publication_id", referencedColumnName="id")
     */
    private $publicationId;

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
     * @return Ref
     */
    public function setName($name)
    {
        $this->refName = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->refName;
    }

    /**
     * Set publicationYear
     *
     * @param integer $publicationYear
     *
     * @return Ref
     */
    public function setPublicationYear($publicationYear)
    {
        $this->publicationYear = $publicationYear;

        return $this;
    }

    /**
     * Get publicationYear
     *
     * @return integer
     */
    public function getPublicationYear()
    {
        return $this->publicationYear;
    }

    /**
     * Set publicationId
     *
     * @param \AppBundle\Entity\Publication $publicationId
     *
     * @return Ref
     */
    public function setPublicationId(\AppBundle\Entity\Publication $publicationId = null)
    {
        $this->publicationId = $publicationId;

        return $this;
    }

    /**
     * Get publicationId
     *
     * @return \AppBundle\Entity\Publication
     */
    public function getPublicationId()
    {
        return $this->publicationId;
    }

    public function __toString()
    {
        return $this->refName;
    }

    /**
     * Set refName
     *
     * @param string $refName
     *
     * @return Ref
     */
    public function setRefName($refName)
    {
        $this->refName = $refName;

        return $this;
    }

    /**
     * Get refName
     *
     * @return string
     */
    public function getRefName()
    {
        return $this->refName;
    }
}

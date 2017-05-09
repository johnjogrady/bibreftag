<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Publication
 *
 * @ORM\Table(name="Publication")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicationRepository")
 */

class Publication

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
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $publicationLocation;

    /**
     * @return string
     */
    public function getPublicationLocation()
    {
        return $this->publicationLocation;
    }

    /**
     * @param string $publicationLocation
     */
    public function setPublicationLocation($publicationLocation)
    {
        $this->publicationLocation = $publicationLocation;
    }

    /**
     * Get id
     *
     * @return integer
     */

    /**
     * @ORM\ManyToOne(targetEntity="PublicationCategory")
     * @ORM\JoinColumn(name="publication_category_id", referencedColumnName="id")
     */
    private $publicationCategory;


    public function __toString()
    {
        return $this->name;
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
     * Set name
     *
     * @param string $name
     *
     * @return Publication
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set publicationType
     *
     * @param \AppBundle\Entity\PublicationCategory $publicationType
     *
     * @return Publication
     */
    public function setPublicationType(\AppBundle\Entity\PublicationCategory $publicationType = null)
    {
        $this->publicationType = $publicationType;

        return $this;
    }

    /**
     * Get publicationType
     *
     * @return \AppBundle\Entity\PublicationCategory
     */
    public function getPublicationCategory()
    {
        return $this->publicationCategory;
    }

    /**
     * Set publicationCategory
     *
     * @param \AppBundle\Entity\PublicationCategory $publicationCategory
     *
     * @return Publication
     */
    public function setPublicationCategory(\AppBundle\Entity\PublicationCategory $publicationCategory = null)
    {
        $this->publicationCategory = $publicationCategory;

        return $this;
    }


}

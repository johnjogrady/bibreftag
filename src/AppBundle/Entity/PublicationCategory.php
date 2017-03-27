<?php
/**
 * Created by PhpStorm.
 * User: john.ogrady
 * Date: 27/03/2017
 * Time: 22:09
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Tag
 *
 * @ORM\Table(name="PublicationCategory")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicationCategoryRepository")
 */

class PublicationCategory

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
    private $publicationCategory;

    

    public function __toString()
    {
        return $this->publicationCategory;
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
     * Set publicationCategory
     *
     * @param string $publicationCategory
     *
     * @return PublicationCategory
     */
    public function setPublicationCategory($publicationCategory)
    {
        $this->publicationCategory = $publicationCategory;

        return $this;
    }

    /**
     * Get publicationCategory
     *
     * @return string
     */
    public function getPublicationCategory()
    {
        return $this->publicationCategory;
    }
}

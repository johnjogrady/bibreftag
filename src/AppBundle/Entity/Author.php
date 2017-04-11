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
 * @ORM\Table(name="Author")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AuthorRepository")
 */

class Author

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
     * @return Author
     */
    public function setName($name)
    {
        $this->Name = $name;

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

    public function __toString()
    {
        return $this->name;
    }

}

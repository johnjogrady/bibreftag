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
 * @ORM\Table(name="Tag")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TagRepository")
 */

class Tag

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
    private $tagName;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $confirmed;


    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $ownerId;

    /**
     * @return mixed
     */
    public function getOwnerId()
    {
        return $this->ownerId;
    }

    /**
     * @param mixed $ownerId
     */
    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;
    }

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $isPrivate;

    /**
     * @return boolean
     */
    public function isIsPrivate()
    {
        return $this->isPrivate;
    }

    /**
     * @param boolean $isPrivate
     */
    public function setIsPrivate($isPrivate)
    {
        $this->isPrivate = $isPrivate;
    }


    /**
     * @var date
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $lastEditDate;

    /**
     * @return date
     */
    public function getLastEditDate()
    {
        return $this->lastEditDate;
    }

    /**
     * @param date $lastEditDate
     */
    public function setLastEditDate($lastEditDate)
    {
        $this->lastEditDate = $lastEditDate;
    }


    /**
     * @return boolean
     */
    public function isConfirmed()
    {
        return $this->confirmed;
    }




    /**
     * @param boolean $confirmed
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="numVotes", type="integer")
     */
    private $numVotes;

    /**
     * @return int
     */
    public function getNumVotes()
    {
        return $this->numVotes;
    }

    /**
     * @param int $numVotes
     */
    public function setNumVotes($numVotes)
    {
        $this->numVotes = $numVotes;
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
     * Set tagName
     *
     * @param string $tagName
     *
     * @return Tag
     */
    public function setTagName($tagName)
    {
        $this->tagName = $tagName;

        return $this;
    }

    /**
     * Get tagName
     *
     * @return string
     */
    public function getTagName()
    {
        return $this->tagName;
    }

    /**
     * Get confirmed
     *
     * @return boolean
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }

    public function __toString()
    {
        return $this->tagName;
    }
}

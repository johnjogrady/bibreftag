<?php
/**
 * Created by PhpStorm.
 * User: john.ogrady
 * Date: 02/04/2017
 * Time: 11:03
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
/**
 * Ref
 *
 * @ORM\Table(name="RefTag")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RefTagRepository")
 */
class RefTag
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
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getRefId()
    {
        return $this->refId;
    }

    /**
     * @param mixed $refId
     */
    public function setRefId($refId)
    {
        $this->refId = $refId;
    }

    /**
     * @return mixed
     */
    public function getTagId()
    {
        return $this->tagId;
    }

    /**
     * @param mixed $tagId
     */
    public function setTagId($tagId)
    {
        $this->tagId = $tagId;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Ref", inversedBy="refName")
     * @ORM\JoinColumn(name="ref_id", referencedColumnName="id")
     */
    private $refId;

    /**
     * @ORM\ManyToOne(targetEntity="Tag", inversedBy="tagName")
     * @ORM\JoinColumn(name="tag_id", referencedColumnName="id")
     */
    private $tagId;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

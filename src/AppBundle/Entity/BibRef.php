<?php
/**
 * Created by PhpStorm.
 * User: john.ogrady
 * Date: 02/04/2017
 * Time: 22:32
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * BibRef
 *
 * @ORM\Table(name="BibRef")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BibRefRepository")
 */

class BibRef
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
     * @ORM\ManyToOne(targetEntity="Ref", inversedBy="refName")
     * @ORM\JoinColumn(name="ref_id", referencedColumnName="id")
     */
    private $refId;

    /**
     * @ORM\ManyToOne(targetEntity="Bib")
     * @ORM\JoinColumn(name="bib_id", referencedColumnName="id")
     */
    private $bibId;

    /**
     * @var int
     * @ORM\Column(name="sequence_id", type="integer")
     */
    private $sequenceId;





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
     * Set sequenceId
     *
     * @param integer $sequenceId
     *
     * @return BibRef
     */
    public function setSequenceId($sequenceId)
    {
        $this->sequenceId = $sequenceId;

        return $this;
    }

    /**
     * Get sequenceId
     *
     * @return integer
     */
    public function getSequenceId()
    {
        return $this->sequenceId;
    }

    /**
     * Set refId
     *
     * @param \AppBundle\Entity\Ref $refId
     *
     * @return BibRef
     */
    public function setRefId(\AppBundle\Entity\Ref $refId = null)
    {
        $this->refId = $refId;

        return $this;
    }

    /**
     * Get refId
     *
     * @return \AppBundle\Entity\Ref
     */
    public function getRefId()
    {
        return $this->refId;
    }

    /**
     * Set bibId
     *
     * @param \AppBundle\Entity\Bib $bibId
     *
     * @return BibRef
     */
    public function setBibId(\AppBundle\Entity\Bib $bibId = null)
    {
        $this->bibId = $bibId;

        return $this;
    }

    /**
     * Get bibId
     *
     * @return \AppBundle\Entity\Bib
     */
    public function getBibId()
    {
        return $this->bibId;
    }


}

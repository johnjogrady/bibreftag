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
 * SharedRef
 *
 * @ORM\Table(name="SharedRef")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SharedRefRepository")
 */

class SharedRef
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

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
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="userId")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userId;

    /**
     * @ORM\ManyToOne(targetEntity="Ref")
     * @ORM\JoinColumn(name="ref_id", referencedColumnName="id")
     */
    private $refId;



}

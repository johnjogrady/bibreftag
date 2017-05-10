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
 * SharedBib
 *
 * @ORM\Table(name="SharedBib")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SharedBibRepository")
 */

class SharedBib
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
    public function getBibId()
    {
        return $this->bibId;
    }

    /**
     * @param mixed $bibId
     */
    public function setBibId($bibId)
    {
        $this->bibId = $bibId;
    }

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="userId")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userId;

    /**
     * @ORM\ManyToOne(targetEntity="Bib")
     * @ORM\JoinColumn(name="bib_id", referencedColumnName="id")
     */
    private $bibId;



}

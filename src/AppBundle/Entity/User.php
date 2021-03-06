<?php

namespace AppBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @UniqueEntity(fields={"email"}, message="There is already an account registered with that email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPrivate;

    /**
 * @return mixed
 */
public function getIsPrivate()
{
    return $this->isPrivate;
}/**
 * @param mixed $isPrivate
 */
public function setIsPrivate($isPrivate)
{
    $this->isPrivate = $isPrivate;
}

    /**
     * @ORM\Column(type="string")
     */
    private $username;

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username= $username;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $userPic;

    /**
     * @return mixed
     */
    public function getUserPic()
    {
        return $this->userPic;
    }

    /**
     * @param mixed $userPic
     */
    public function setUserPic($userPic)
    {
        $this->userPic = $userPic;
    }

    /**
     * @return mixed
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param mixed $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * @ORM\Column(type="string", unique=true)
     */
    private $email;

    /**
     * The encoded password
     *
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @Assert\NotBlank(groups={"Registration"})
     *
     * @var string
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string")
     */
    private $role;
    // You have to keep this method due to the UserInterface
    public function getRoles()
    {
        return [$this->role];
    }

    public function setRoles(array $roles)
    {
        throw new \Exception('You probably never need to call it, but UserInterface enforce you to have this method');
    }


    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        // leaving blank - I don't need/have a password!
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        // forces the object to look "dirty" to Doctrine. Avoids saving only if plain password changes
        $this->password = null;
    }


    public function __toString()
    {
        return strval($this->username);
    }


}

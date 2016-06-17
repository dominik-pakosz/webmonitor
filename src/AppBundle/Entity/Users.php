<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users", indexes={@ORM\Index(name="idx_uid", columns={"user_username"}), @ORM\Index(name="idx_pwd", columns={"user_password"}), @ORM\Index(name="idx_user_parent", columns={"user_parent"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsersRepository")
 */
class Users
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_contact", type="integer", nullable=false)
     */
    private $userContact;

    /**
     * @var string
     *
     * @ORM\Column(name="user_username", type="string", length=255, nullable=false)
     */
    private $userUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="user_password", type="string", length=32, nullable=false)
     */
    private $userPassword;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_parent", type="integer", nullable=false)
     */
    private $userParent;

    /**
     * @var boolean
     *
     * @ORM\Column(name="user_type", type="boolean", nullable=false)
     */
    private $userType;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_company", type="integer", nullable=true)
     */
    private $userCompany;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_department", type="integer", nullable=true)
     */
    private $userDepartment;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_owner", type="integer", nullable=false)
     */
    private $userOwner;

    /**
     * @var string
     *
     * @ORM\Column(name="user_signature", type="text", length=65535, nullable=true)
     */
    private $userSignature;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;



    /**
     * Set userContact
     *
     * @param integer $userContact
     * @return Users
     */
    public function setUserContact($userContact)
    {
        $this->userContact = $userContact;

        return $this;
    }

    /**
     * Get userContact
     *
     * @return integer 
     */
    public function getUserContact()
    {
        return $this->userContact;
    }

    /**
     * Set userUsername
     *
     * @param string $userUsername
     * @return Users
     */
    public function setUserUsername($userUsername)
    {
        $this->userUsername = $userUsername;

        return $this;
    }

    /**
     * Get userUsername
     *
     * @return string 
     */
    public function getUserUsername()
    {
        return $this->userUsername;
    }

    /**
     * Set userPassword
     *
     * @param string $userPassword
     * @return Users
     */
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;

        return $this;
    }

    /**
     * Get userPassword
     *
     * @return string 
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    /**
     * Set userParent
     *
     * @param integer $userParent
     * @return Users
     */
    public function setUserParent($userParent)
    {
        $this->userParent = $userParent;

        return $this;
    }

    /**
     * Get userParent
     *
     * @return integer 
     */
    public function getUserParent()
    {
        return $this->userParent;
    }

    /**
     * Set userType
     *
     * @param boolean $userType
     * @return Users
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;

        return $this;
    }

    /**
     * Get userType
     *
     * @return boolean 
     */
    public function getUserType()
    {
        return $this->userType;
    }

    /**
     * Set userCompany
     *
     * @param integer $userCompany
     * @return Users
     */
    public function setUserCompany($userCompany)
    {
        $this->userCompany = $userCompany;

        return $this;
    }

    /**
     * Get userCompany
     *
     * @return integer 
     */
    public function getUserCompany()
    {
        return $this->userCompany;
    }

    /**
     * Set userDepartment
     *
     * @param integer $userDepartment
     * @return Users
     */
    public function setUserDepartment($userDepartment)
    {
        $this->userDepartment = $userDepartment;

        return $this;
    }

    /**
     * Get userDepartment
     *
     * @return integer 
     */
    public function getUserDepartment()
    {
        return $this->userDepartment;
    }

    /**
     * Set userOwner
     *
     * @param integer $userOwner
     * @return Users
     */
    public function setUserOwner($userOwner)
    {
        $this->userOwner = $userOwner;

        return $this;
    }

    /**
     * Get userOwner
     *
     * @return integer 
     */
    public function getUserOwner()
    {
        return $this->userOwner;
    }

    /**
     * Set userSignature
     *
     * @param string $userSignature
     * @return Users
     */
    public function setUserSignature($userSignature)
    {
        $this->userSignature = $userSignature;

        return $this;
    }

    /**
     * Get userSignature
     *
     * @return string 
     */
    public function getUserSignature()
    {
        return $this->userSignature;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }
}

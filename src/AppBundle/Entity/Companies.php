<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Companies
 *
 * @ORM\Table(name="companies", indexes={@ORM\Index(name="idx_cpy1", columns={"company_owner"})})
 * @ORM\Entity
 */
class Companies
{
    /**
     * @var integer
     *
     * @ORM\Column(name="company_module", type="integer", nullable=false)
     */
    private $companyModule;

    /**
     * @var string
     *
     * @ORM\Column(name="company_name", type="string", length=100, nullable=true)
     */
    private $companyName;

    /**
     * @var string
     *
     * @ORM\Column(name="company_phone1", type="string", length=30, nullable=true)
     */
    private $companyPhone1;

    /**
     * @var string
     *
     * @ORM\Column(name="company_phone2", type="string", length=30, nullable=true)
     */
    private $companyPhone2;

    /**
     * @var string
     *
     * @ORM\Column(name="company_fax", type="string", length=30, nullable=true)
     */
    private $companyFax;

    /**
     * @var string
     *
     * @ORM\Column(name="company_address1", type="string", length=50, nullable=true)
     */
    private $companyAddress1;

    /**
     * @var string
     *
     * @ORM\Column(name="company_address2", type="string", length=50, nullable=true)
     */
    private $companyAddress2;

    /**
     * @var string
     *
     * @ORM\Column(name="company_city", type="string", length=30, nullable=true)
     */
    private $companyCity;

    /**
     * @var string
     *
     * @ORM\Column(name="company_state", type="string", length=30, nullable=true)
     */
    private $companyState;

    /**
     * @var string
     *
     * @ORM\Column(name="company_zip", type="string", length=11, nullable=true)
     */
    private $companyZip;

    /**
     * @var string
     *
     * @ORM\Column(name="company_primary_url", type="string", length=255, nullable=true)
     */
    private $companyPrimaryUrl;

    /**
     * @var integer
     *
     * @ORM\Column(name="company_owner", type="integer", nullable=false)
     */
    private $companyOwner;

    /**
     * @var string
     *
     * @ORM\Column(name="company_description", type="text", length=65535, nullable=true)
     */
    private $companyDescription;

    /**
     * @var integer
     *
     * @ORM\Column(name="company_type", type="integer", nullable=false)
     */
    private $companyType;

    /**
     * @var string
     *
     * @ORM\Column(name="company_email", type="string", length=255, nullable=true)
     */
    private $companyEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="company_custom", type="text", nullable=true)
     */
    private $companyCustom;

    /**
     * @var integer
     *
     * @ORM\Column(name="company_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $companyId;



    /**
     * Set companyModule
     *
     * @param integer $companyModule
     * @return Companies
     */
    public function setCompanyModule($companyModule)
    {
        $this->companyModule = $companyModule;

        return $this;
    }

    /**
     * Get companyModule
     *
     * @return integer 
     */
    public function getCompanyModule()
    {
        return $this->companyModule;
    }

    /**
     * Set companyName
     *
     * @param string $companyName
     * @return Companies
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string 
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set companyPhone1
     *
     * @param string $companyPhone1
     * @return Companies
     */
    public function setCompanyPhone1($companyPhone1)
    {
        $this->companyPhone1 = $companyPhone1;

        return $this;
    }

    /**
     * Get companyPhone1
     *
     * @return string 
     */
    public function getCompanyPhone1()
    {
        return $this->companyPhone1;
    }

    /**
     * Set companyPhone2
     *
     * @param string $companyPhone2
     * @return Companies
     */
    public function setCompanyPhone2($companyPhone2)
    {
        $this->companyPhone2 = $companyPhone2;

        return $this;
    }

    /**
     * Get companyPhone2
     *
     * @return string 
     */
    public function getCompanyPhone2()
    {
        return $this->companyPhone2;
    }

    /**
     * Set companyFax
     *
     * @param string $companyFax
     * @return Companies
     */
    public function setCompanyFax($companyFax)
    {
        $this->companyFax = $companyFax;

        return $this;
    }

    /**
     * Get companyFax
     *
     * @return string 
     */
    public function getCompanyFax()
    {
        return $this->companyFax;
    }

    /**
     * Set companyAddress1
     *
     * @param string $companyAddress1
     * @return Companies
     */
    public function setCompanyAddress1($companyAddress1)
    {
        $this->companyAddress1 = $companyAddress1;

        return $this;
    }

    /**
     * Get companyAddress1
     *
     * @return string 
     */
    public function getCompanyAddress1()
    {
        return $this->companyAddress1;
    }

    /**
     * Set companyAddress2
     *
     * @param string $companyAddress2
     * @return Companies
     */
    public function setCompanyAddress2($companyAddress2)
    {
        $this->companyAddress2 = $companyAddress2;

        return $this;
    }

    /**
     * Get companyAddress2
     *
     * @return string 
     */
    public function getCompanyAddress2()
    {
        return $this->companyAddress2;
    }

    /**
     * Set companyCity
     *
     * @param string $companyCity
     * @return Companies
     */
    public function setCompanyCity($companyCity)
    {
        $this->companyCity = $companyCity;

        return $this;
    }

    /**
     * Get companyCity
     *
     * @return string 
     */
    public function getCompanyCity()
    {
        return $this->companyCity;
    }

    /**
     * Set companyState
     *
     * @param string $companyState
     * @return Companies
     */
    public function setCompanyState($companyState)
    {
        $this->companyState = $companyState;

        return $this;
    }

    /**
     * Get companyState
     *
     * @return string 
     */
    public function getCompanyState()
    {
        return $this->companyState;
    }

    /**
     * Set companyZip
     *
     * @param string $companyZip
     * @return Companies
     */
    public function setCompanyZip($companyZip)
    {
        $this->companyZip = $companyZip;

        return $this;
    }

    /**
     * Get companyZip
     *
     * @return string 
     */
    public function getCompanyZip()
    {
        return $this->companyZip;
    }

    /**
     * Set companyPrimaryUrl
     *
     * @param string $companyPrimaryUrl
     * @return Companies
     */
    public function setCompanyPrimaryUrl($companyPrimaryUrl)
    {
        $this->companyPrimaryUrl = $companyPrimaryUrl;

        return $this;
    }

    /**
     * Get companyPrimaryUrl
     *
     * @return string 
     */
    public function getCompanyPrimaryUrl()
    {
        return $this->companyPrimaryUrl;
    }

    /**
     * Set companyOwner
     *
     * @param integer $companyOwner
     * @return Companies
     */
    public function setCompanyOwner($companyOwner)
    {
        $this->companyOwner = $companyOwner;

        return $this;
    }

    /**
     * Get companyOwner
     *
     * @return integer 
     */
    public function getCompanyOwner()
    {
        return $this->companyOwner;
    }

    /**
     * Set companyDescription
     *
     * @param string $companyDescription
     * @return Companies
     */
    public function setCompanyDescription($companyDescription)
    {
        $this->companyDescription = $companyDescription;

        return $this;
    }

    /**
     * Get companyDescription
     *
     * @return string 
     */
    public function getCompanyDescription()
    {
        return $this->companyDescription;
    }

    /**
     * Set companyType
     *
     * @param integer $companyType
     * @return Companies
     */
    public function setCompanyType($companyType)
    {
        $this->companyType = $companyType;

        return $this;
    }

    /**
     * Get companyType
     *
     * @return integer 
     */
    public function getCompanyType()
    {
        return $this->companyType;
    }

    /**
     * Set companyEmail
     *
     * @param string $companyEmail
     * @return Companies
     */
    public function setCompanyEmail($companyEmail)
    {
        $this->companyEmail = $companyEmail;

        return $this;
    }

    /**
     * Get companyEmail
     *
     * @return string 
     */
    public function getCompanyEmail()
    {
        return $this->companyEmail;
    }

    /**
     * Set companyCustom
     *
     * @param string $companyCustom
     * @return Companies
     */
    public function setCompanyCustom($companyCustom)
    {
        $this->companyCustom = $companyCustom;

        return $this;
    }

    /**
     * Get companyCustom
     *
     * @return string 
     */
    public function getCompanyCustom()
    {
        return $this->companyCustom;
    }

    /**
     * Get companyId
     *
     * @return integer 
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }
}

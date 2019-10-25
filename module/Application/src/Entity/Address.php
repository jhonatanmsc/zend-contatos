<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Contacts\src\Entity\Contacts;

/**
 * Address
 *
 * @ORM\Entity
 * @ORM\Table(name="address")
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $street;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    protected $number;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $district;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $city;

    /**
     * Many Groups have Many Users.
     * @ORM\OneToOne(targetEntity="Contact", mappedBy="address")
     * @ORM\JoinColumn(nullable=true)
     */
    private $contact;

    public function __construct() {
        // $this->contacts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getContact()
    {
        return $this->contact;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getDistrict()
    {
        return $this->district;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setContact($contact)
    {
        $this->contacts = $contact;
        return $this;
    }

    public function setStreet($street)
    {
        $this->street = $street;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function setDistrict($district)
    {
        $this->district = $district;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }
}